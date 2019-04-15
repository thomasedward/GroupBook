
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
    imageupload:'',
    message: 'Hello Vue! by Thomas ',
    content: '',
    updatedContent:'',
    contentcomment:{},
    posts:[],
    likes:[],
      Allusers:[],
      results11:[],
    commentSeen:false,
    bUrl: 'http://127.0.0.1:8000',
    myObject: null,
    qry:''

  },
  created(){
    //fetch posts
    axios.get(this.bUrl + '/posts')
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
    axios.get(this.bUrl + '/likes')
    .then(response => {
      console.log('Save Successfull');
      this.likes = response.data;

    })
    .catch(error => {
      console.log(error)
    });

    //fetch all user
    axios.get(this.bUrl + '/Allusers')
        .then(response => {
          console.log('Save Successfull');
          this.Allusers = response.data;

        })
        .catch(error => {
          console.log(error)
        });
  },
  methods:{
    addPost(){
      axios.post(this.bUrl + '/addPost',{
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
      axios.get(this.bUrl + '/deletePost/' + id)
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
    openModal(post_id){
      axios.get(this.bUrl + '/post/' + post_id)
          .then(response => {
            console.log( response.data);
            if (response.data === 'done')
            {
              app.updatedContent = '';
            }else{
              app.updatedContent = response.data;
            }

          })
          .catch(error => {
            console.log(error)
          })
    },
    updatePost(post_id){

      axios.post(this.bUrl + '/updatePost',{
        updatedContent:this.updatedContent,
        post_id:post_id
      })
          .then(response => {
            console.log('Save Successfull');

            if(response.status === 200)
            {
              app.posts = response.data;
            }
          })
          .catch(error => {
            console.log(error)
          })
    },
    likePost(id){
      axios.get(this.bUrl + '/likePost/' + id)
      .then(response => {
        console.log( response.data);
        app.posts = response.data;
      })
      .catch(error => {
        console.log(error)
      })
    },
    addComment(post,key){

      axios.post(this.bUrl + '/addComment',{
        contentcomment:this.contentcomment[key],
        post_id:post.post_id
      })
          .then(response => {
            console.log('Save Successfull');

            if(response.status === 200)
            {
              this.contentcomment = '';

            }
          })
          .catch(error => {
            console.log(error)
          })

    },
    onFileChange(e){
      var files = e.target.files || e.dataTransfer.files;
      this.createImg(files[0]); // files the image/ file value to our function
      console.log('onfile');

    },
    createImg(file){
      // we will preview our image before upload
      var imageupload = new Image;
      var reader = new FileReader;
      console.log('1create');

      reader.onload = (e) =>{
        this.imageupload = e.target.result;
        console.log('2create');
      };
      reader.readAsDataURL(file);
    },
    uploadImg(){
      axios.post(this.bUrl + '/uploadImg',{
        imageupload:this.imageupload,
        content:this.content
      })
          .then(response => {
            console.log('Save Successfull');
            this.imageupload = "";
            this.content = "";
            if(response.status === 200)
            {
              this.imageupload = "";
              this.content = "";
              console.log('Save now');
            }
          })
          .catch(error => {
            console.log(error)
          })
    },
    removeImg(){
      this.imageupload='';
    },
      autoComplete(){
        this.results = [];
          axios.post(this.bUrl + '/search',{
              qry:this.qry
          })
              .then(response => {
                  console.log('Save Successfull');
                  if(response.status === 200)
                  {
                    app.results = response.data;
                  }
              })
              .catch(error => {
                  console.log(error)
              })
      }

  },


});
