
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
    message: 'Hello Vue! by Thomas ',
    content: '',
    posts:[],
    likes:[],
  },
  created(){
    //fetch posts
    axios.get('http://127.0.0.1:8000/posts')
    .then(response => {
      console.log('Save Successfull');
      this.posts = response.data;
      Vue.filter('myOwnTime', function(value){
        return moment(value).fromNow();
      });
    })
    .catch(error => {
      console.log(error)
    });

    //fetch likse
    axios.get('http://127.0.0.1:8000/likes')
    .then(response => {
      console.log('Save Successfull');
      this.likes = response.data;

    })
    .catch(error => {
      console.log(error)
    });
  },
  methods:{
    addPost(){
      axios.post('http://127.0.0.1:8000/addPost',{
        content:this.content
      })
      .then(response => {
        console.log('Save Successfull');

        if(response.status === 200)
        {
          this.content = '';
          app.posts = response.data;
        }
      })
      .catch(error => {
        console.log(error)
      })
    },
    DeletePost(id){
      axios.get('http://127.0.0.1:8000/deletePost/' + id)
      .then(response => {
        console.log( response.data);
        if( response.data == 'No Messages')
        {
          app.singleMsgs = [];

        }
        else {
        app.posts = response.data;
        }

      })
      .catch(error => {
        console.log(error)
      })
    }
    ,
    likePost(id){
      axios.get('http://127.0.0.1:8000/likePost/' + id)
      .then(response => {
        console.log( response.data);
        app.posts = response.data;
      })
      .catch(error => {
        console.log(error)
      })
    },
  }


});
