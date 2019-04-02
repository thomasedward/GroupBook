
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
  data: {
    message: ' ',
    privsteMsgs:[],
    singleMsgs:[],
    msgFrom:'',
    conID:'',
    friend_id: '',
    seen: false,
    newMsgFrom: ''
  },
  created(){
    axios.get('http://127.0.0.1:8000/getMessages')
    .then(response => {
      console.log( response.data);
      app.privsteMsgs = response.data;
    })
    .catch(error => {
      console.log(error)
    })
  },
  methods:{
    messages:function(id){
      axios.get('http://127.0.0.1:8000/getMessages/' + id)
      .then(response => {
        console.log( response.data);
        if( response.data == 'No Messages')
        {
          app.singleMsgs = [];

        }
        else {
          app.singleMsgs = response.data;
            app.conID = response.data[0].conversation_id;
        }

      })
      .catch(error => {
        console.log(error)
      })
    },
    inputHandler(e){
  if(e.keyCode ===13 && !e.shiftKey){
    e.preventDefault();
    this.sendMsg();
  }
},
sendMsg(){
  if(this.msgFrom){
    axios.post('http://127.0.0.1:8000/sendMessage', {
           conID: this.conID,
           msg: this.msgFrom
         })
         .then( (response) => {
           console.log(response.data); // show if success

           if(response.status===200){
             app.singleMsgs = response.data;
           }

         })
         .catch(function (error) {
           console.log(error); // run if we have error
         });

  }
},


friendID: function(id){
  app.friend_id = id;

},
sendNewMsg(){
  axios.post('http://127.0.0.1:8000/sendNewMessage', {
         friend_id: this.friend_id,
         msg: this.newMsgFrom,
       })
       .then(function (response) {
         console.log(response.data); // show if success
         if(response.status===200){
           window.location.replace('http://127.0.0.1:8000/messages');
           app.message = 'your message has been sent successfully';
         }

       })
       .catch(function (error) {
         console.log(error); // run if we have error
       });
}
  }


});
