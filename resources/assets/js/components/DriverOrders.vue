<template>
 <div> 
    <section class="content-header">
 <vue-toast ref='toast'></vue-toast>
      <h1 align="center">
      NEW ORDER LIST
      </h1>
    </section>

<div class="container-fluid display-page" id="display-post-category" >
 
<!-- @order -->
        <modal  v-if="modal.get('order')" @close="modal.set('order', false)"  >
        <template slot="header" ><h4 align="center">Address</h4></template>
        <template slot="body" >
		<form method="POST" action="" @submit.prevent="SubmitData()" enctype="multipart/form-data">
                <div class="modal-body">

                    

                    <!-- form Group -->
                    <div class="form-group">
<textarea v-model="address" class="form-control" rows="5" id="message" placeholder="Address" required></textarea>
  <span class="label label-danger" v-for="error of errorNya">
                        {{ error }}
                    </span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('order', false)" >Close</button>
					<button type="submit" class="btn btn-primary">Order</button>
                </div>
				</form>
        </template>
        </modal>


</div>


   <section class="content">
      <div class="row">
      <div class="col-md-12">

<div class="filter-bar">
<div class="form-inline">
<div class="dropdown form-inline pull-left">
                <label>Per Page:</label>

                <select class="form-control" v-model="perPage">
                    <option :value=10>10</option>
                    <option :value=25>25</option>
                    <option :value=50>50</option>
                    <option :value=75>75</option>
                    <option :value=100>100</option>
                </select>
            </div>
             

       </div>
       
    




    </div>
    <br>
    <div style="overflow-x:auto;">
    <vuetable ref="vuetable"
      api-url="/driver/order-list"
      :fields="fields"
      pagination-path=""
      :selected-to="selectedRow"
      :per-page="perPage"
      track-by="id"
      :css="css.table"
      :multi-sort="true"
      :append-params="moreParams"
      @vuetable:cell-clicked="onCellClicked"
      @vuetable:pagination-data="onPaginationData"
	  @vuetable:loading="onLoading"        
		@vuetable:load-error="onLoadingError"        
		@vuetable:load-success="onLoaded"
    ></vuetable>
    <div class="vuetable-pagination">
      <vuetable-pagination-info ref="paginationInfo"
        info-class="pagination-info"
      ></vuetable-pagination-info>
      <vuetable-pagination ref="pagination"
        :css="css.pagination"
        @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
    </div>


      </div>
      </div>
      </section>
	  <br>
	  <br>
	  <br>
	  
	      <section class="content-header">
      <h1 align="center">
      JOBS LIST
      </h1>
    </section>
	  <section class="content">
      <div class="row">
      <div class="col-md-12">

 <table class="table">
    <thead>
      <tr>
        <th align="center">NO</th>
        <th align="center">Item Name</th>
        <th align="center">Address</th>
        <th align="center">Status</th>
      </tr>
    </thead>
    <tbody v-if="this.orderanya.length > 0">
      <tr v-for="(row,index) in this.orderanya">
        <td align="left">{{index+1}} </td>
        <td align="left">{{row.header.itemname}} </td>
        <td align="left">{{row.header.address}} </td>
        <td align="left">
		<div v-for="(rowyangkedua,index) in row.detail">
		 {{rowyangkedua.statusnya}}
		<br>
		<div v-if="rowyangkedua.description === 'Order Taken By Driver' && row.detail.length === 2">
		<button class="btn btn-sm btn-primary" @click="Delivery(row.header.id,row.header.userid,2)">Change to Delivery</button>
		</div>
		<div v-if="rowyangkedua.description === 'Order On Delivery' && row.detail.length === 3">
		<button class="btn btn-sm btn-warning" @click="Delivery(row.header.id,row.header.userid,3)">Change to Delivered</button>
		</div>
		</div>
		
		</td>
      </tr>
    </tbody>
    <tbody v-else>
      <tr>
        <td align="center" colspan="4"> No result data </td>
      </tr>
    </tbody>
  </table>

      </div>
      </div>
      </section>
	  
	  
    </div>
</template>
<script>
     /* ------------------------------------------------------------------------------------- ERRORS
         ---------------------------------------------------------------------------------------------------- */
        class Errors{
            constructor(){
                this.errors = {};
            }
            get(field){
                if(this.errors[field]){
                    return  this.errors[field][0];
                }
            }
            record(errors){
                this.errors = errors.response.data;
            }
            any(){
                return Object.keys(this.errors).length > 0;
            }
            has(field){
                return this.errors.hasOwnProperty(field);
            }
            clear(field){
                if(field) delete this.errors[field];
                this.errors = {};
            }
            clearAll(){
                this.errors = "";
            }
        }
        /* ------------------------------------------------------------------------------------- CRUD FORM
         ---------------------------------------------------------------------------------------------------- */
        class CrudForm {
            constructor(data) {
                this.originalData = data;
                for(let field in data){
                    this[field] = data[field];
                }
            }
            reset(){
                for(let field in this.originalData){
                    this[field] = '';
                }
            }
            /*  Set a value to the temp , verify if has this item and update  */
            setFillItem(item , index){
                for(let field in this.originalData){
                    if(field in item){
                        this[field] = item[field];
                    }else{
                        // if is index
                        if(field == 'index'){ this[field] = index; }
                    }
                }
            }
            data(){
                let data = Object.assign({} , this);
                delete data.originalData;
                delete data.errors;
                return data;
            }
        }
        /* ------------------------------------------------------------------------------------- CRUD MODAL
         ---------------------------------------------------------------------------------------------------- */
        class CrudModal{
            constructor(data){
                this.modal = data;
            }
            get(value){
                if(this.modal[value]){
                    return this.modal[value];
                }
            }
            set(data , value){
                this.modal[data] = value;
            }
        }
        // -----------------------------------------------------------------------------------------------  COMPONENT MODAL
        const Modal = {
            template: `   <transition name="modal">
                                <div class="modal-mask">
                                  <div class="modal-wrapper">
                                    <div :class="modalStyle">
                                    <a class="close-modal" @click="$emit('close')" ></a>
                                      <div class="modal-header">
                                           <p class="modal-card-title"><slot name="header" class="modal-card-title "></slot></p>
                                      </div>
                                        <slot name="body">
                                          default body
                                        </slot>
                                    </div>
                                  </div>
                                </div>
                              </transition>` ,
            props: {
                modalsize: {type: String},
            } ,
            computed: {
                modalStyle() {
                    return this.modalsize == null ? 'modal-container' : this.modalsize + ' modal-container';
                },
                created(){

                }
            }
        };
		
		
		
Vue.component('my-driver-button', require('./BooksCustomActionsDriver.vue'))
import accounting from 'accounting'
import moment from 'moment'
import '!!vue-style-loader!css-loader!vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'
import myDatepicker from 'vue-datepicker'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2'
import VueEvents from 'vue-events'
Vue.use(VueEvents)
Vue.use(VueSweetalert2)
window.axios = require('axios')
window.eventBus = new Vue()
 Vue.component('modal', Modal)
export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
     'vue-toast': VueToast,
     'date-picker': myDatepicker,
  },
  data () {
    return {
    selectedRow: [],
    startTime: {
        time: ''
      },
      endtime: {
        time: ''
      },
	option: {
        type: 'day',
        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        format: 'YYYY-MM-DD',
        placeholder: 'YYYY-MM-DD',
        inputStyle: {
          'display': 'inline-block',
          'padding': '6px',
          'line-height': '22px',
          'font-size': '16px',
          'border': '2px solid #fff',
          'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
          'border-radius': '2px',
          'color': '#5F5F5F'
        },
        color: {
          header: '#B799DA',
          headerText: '#f00'
        },
        buttons: {
          ok: 'Ok',
          cancel: 'Cancel'
        },
        overlayOpacity: 0.5, // 0.5 as default 
        dismissible: true // as true as default 
      },
    position: 'up right',
    closeBtn: true,
    formErrors:{},
	timer: '',
	 orderanya:'',
	 orderanyaDetail:'',
	address: '',
    errors: new Errors() ,
    forms:new CrudForm({index:'',  id:'' ,name:'',address:'',statusnya:''}) ,
    modal:new CrudModal({order:false }),
     errorNya: [],
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    displayItems:[] ,
    perPage: 10,
    loading: false,
    loading2: false,
      fields: [
      {
          name: '__sequence',
          title: 'No',
          titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'name',
		  title: 'Item Name',
		  titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: 'address',
		  title: 'Address',
		  titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: 'statusnya',
		  title: 'Status',
		  titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: '__component:my-driver-button',
          title: 'Actions',
          titleClass: 'text-center',
          dataClass: 'text-center'
        }
      ],
      filterText: '', 
      css: {
        table: {
          tableClass: 'table table-bordered table-striped table-hover',
          ascendingIcon: 'glyphicon glyphicon-chevron-up',
          descendingIcon: 'glyphicon glyphicon-chevron-down'
        },
        pagination: {
          wrapperClass: 'pagination',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'page',
          linkClass: 'link',
          icons: {
            first: '',
            prev: '',
            next: '',
            last: '',
          },
        },
        icons: {
          first: 'glyphicon glyphicon-step-backward',
          prev: 'glyphicon glyphicon-chevron-left',
          next: 'glyphicon glyphicon-chevron-right',
          last: 'glyphicon glyphicon-step-forward',
        },
      },
      moreParams: {}
    }
  },
          watch: {
            'perPage'(newValue, oldValue) {
               this.$events.fire('filter-set', this.filterText)
            },
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {
		 success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
 error(kata) {
      this.$swal({
  position: 'top-end',
  type: 'error',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
 question(kata) {
      this.$swal(
'Ooppss?',
 kata,
  'question'
)
    },
   resetOptions() {
          this.$refs.toast.setOptions({
            delayOfJumps: this.delayOfJumps,
            maxToasts: this.maxToasts,
            position: this.position
          })
        },

        showTime(kode,pesan) {
          this.$refs.toast.showToast(pesan, {
            theme: kode,
            timeLife: 3000,
          })
        },
            Delivery(id,userid,stts){   
var masuk ={
  id:id,
  userid:userid,
  stts:stts};
this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
if (result.value) {
               axios.post('/driver/take-order', masuk)
                    .then(response => {
                this.errorNya = '';
             this.ready(); 
             this.onLoadingErrorvuetableHistory();
			 if(response.data.success)
			 {
                this.success(response.data.success);			 
			 }
			 else{
			this.error(response.data.error);
			}

                    })
                    .catch(error => {
                      if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
                    });
}
})
            }  ,
            takeItem(item ,index = this.indexOf(item)){   
var masuk ={
  id:item.id,
  userid:item.userid,
  stts:'1'};
this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
if (result.value) {
               axios.post('/driver/take-order', masuk)
                    .then(response => {
                this.errorNya = '';
             this.ready(); 
             this.onLoadingErrorvuetableHistory();
			 if(response.data.success)
			 {
                this.success(response.data.success);			 
			 }
			 else{
			this.error(response.data.error);
			}

                    })
                    .catch(error => {
                      if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
                    });
}
})
            }  ,
        doFilter () {
		if(!this.startTime.time && !this.endtime.time)
		{
		this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
		}
		else if(this.startTime.time && !this.endtime.time)
		{
		this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
		}
		else if(!this.startTime.time && this.endtime.time)
		{
		this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
		}
		else if(this.startTime.time && this.endtime.time)
		{ 
		if(this.endtime.time < this.startTime.time)
		{
		alert('Input Date Wrong');
		}
		else
		{
		this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
		}
		}
		else
		{
		this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
		}
      },
      resetFilter () {
        this.filterText = ''
         this.startTime.time = ''
        this.endtime.time = ''
        this.$events.fire('filter-reset')
      },
    allcap (value) {
      return value.toUpperCase()
    },
    formatNumber (value) {
      return accounting.formatMoney(value,  "Rp. ", 2, ".", ",")
    },
   

	
    formatDate (value, fmt = 'D MMM YYYY') {
      return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
    },
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onPaginationDatavuetableHistory (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    onChangePagevuetableHistory (page) {
      this.$refs.vuetableHistory.changePage(page)
    },
    onCellClicked (data, field, event) {
      //console.log('cellClicked: ', field.title)
      this.$refs.vuetable.toggleDetailRow(data.id)
    },
    onCellClickedvuetableHistory (data, field, event) {
      //console.log('cellClicked: ', field.title)
      this.$refs.vuetableHistory.toggleDetailRow(data.id)
    },          
onLoading() {
     this.loading = true;
    },    
onLoadingvuetableHistory() {
     this.loading = true;
    },
    onLoaded() {
      this.loading = false;
    },
    onLoadedvuetableHistory() {
      this.loading = false;
    },
    onLoadingError() {
                this.loading = true;
                axios.get('/driver/order-list').then((response) => {
                    this.dataNya = response.data;
                    this.loading = false
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                        this.loading = false;
					}
					}
                    });
    },	
    onLoadingErrorvuetableHistory() {
                this.loading = true;
                axios.get('/driver/order-history').then((response) => {
                    this.orderanya = response.data;
                });
    },		

	  ready() {
setInterval(function () {
      this.$events.fire('filter-reset');
      this.onLoadingErrorvuetableHistory();
    }.bind(this), 30000); 
  },
  },
  events: {
    'filter-set' (filterText,startTime,endtime) {
      this.moreParams = {
        filter: filterText,min: startTime, max: endtime
      }
      Vue.nextTick(() => this.$refs.vuetable.refresh() )
    },
    'filter-reset' () {
      this.moreParams = {}
      Vue.nextTick(() => this.$refs.vuetable.refresh() )
    }
  },
 created: function() {
  let self = this;
            this.$root.$on('takeitem', function(data,index){
                //console.log(data);
               self.takeItem(data,index);
            });
			  
        },
		          mounted() {
             this.resetOptions(); 
             this.ready(); 
             this.onLoadingErrorvuetableHistory(); 
        }

}
</script>
<style>
.pagination {
  margin: 0;
  float: right;
}
.pagination a.page {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.page.active {
  color: white;
  background-color: #337ab7;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.btn-nav {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
  cursor: not-allowed;
}
.pagination-info {
  float: left;
}
.modal-backdrop {
z-index: -1;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-container {
  width: 50%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-body {
  margin: 20px 0;
   max-height: calc(100vh - 210px);
    overflow-y: auto;
}
.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>