<template>

 <div>
    <section class="content-header">
      <h1 style="padding-top: 5%;font-size: 50px;" align="center">
      Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Profile</h3>
            </div>
            <div class="box-body">
              <!-- email mask -->
              <div class="form-group">
                <label>Username</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input v-model="dataNya.username" type="text" class="form-control" disabled>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          

        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Password</h3>
            </div>
            <div class="box-body">
            <form @submit.prevent="submitPassword" method="POST">
              <!-- Date -->
              <div class="form-group">
                <label>New Password</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-eye"></i>
                  </div>
                  <input type="password" name="password" v-model="dataPassword.password" class="form-control pull-right" id="password" placeholer="New Password" required>
                   <span class="label label-danger" v-for="error of errors['password']">
                        {{ error }}
                    </span>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Date range -->
              <div class="form-group">
                <label>New Password Confirmation</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-eye"></i>
                  </div>
                  <input type="password" name="password_confirmation" v-model="dataPassword.password_confirmation" class="form-control pull-right" id="password_confirmation" placeholer="New Password Confirmation" required>
                  <span class="label label-danger" v-for="error of errors['password_confirmation']">
                        {{ error }}
                    </span>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
   <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary btn-lg">Submit</button>
              </div>
              <!-- /.form group -->
             
 </form>
             

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
      </section>
 </div>

</template>


<script>
import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2'
window.axios = require('axios')
window.eventBus = new Vue()
Vue.use(VueSweetalert2)


    export default {
        data(){
            return {
                dataNya: {name : ''},
                dataPassword: {password : '',
                password_confirmation: ''},
                loading: false,
                formNya : "",
                errors: [],
                submitted: false,
                token: localStorage.getItem('token')
            }
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
            submitPassword() {
this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
if (result.value) {
               axios.post('/driver/change-password', this.dataPassword)
                    .then(response => {
                this.errors = '';
                this.dataPassword = '';
                this.success(response.data.success);

                    })
                    .catch(error => {
                      this.errors = error.response.data;

                    });
}
})		
			
			
            },
            fetchIt(){
                this.loading = true;
                axios.get('/driver/GetProfile').then((response) => {
                    this.dataNya = response.data;
                    this.loading = false
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.$router.push('/page-not-found');
					}
					}
                    });
            }
        },
        mounted() {
            //console.log(this.token);
            this.fetchIt();

        }
    }
</script>
