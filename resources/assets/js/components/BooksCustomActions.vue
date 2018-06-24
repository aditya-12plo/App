 <template>
    <div class="custom-actions">
      <button class="btn btn-sm" @click="itemAction('order-item', rowData, rowIndex)">ORDER</button>
   </div>

  </template>

  <script>

  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    methods: {
      itemAction (action, data, index) {
      if(action === "order-item")
      {
               this.$root.$emit('orderitem', data , index);
      }
      else
      {
alert('error');
      }
        
      }
      }
      
    
  }
  </script>

  <style>
    .custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>