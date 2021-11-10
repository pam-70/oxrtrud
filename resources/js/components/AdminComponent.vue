<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div id="example-1">
          <button v-on:click="less">Вопрос теста < {{ numer }}</button>
          <button v-on:click="more">Вопрос теста > {{ numer }}</button>
          <p>Номер вопроса {{ numer }}</p>
          <div v-if="recorded!=''" class="alert alert-success" role="alert">
            <strong>{{recorded}}</strong> 
          </div>
          <p>{{ url_question }}</p>
        </div>
        <span>
          <span v-for="answer in url_answer" :key="answer.answer">
            <input
              type="radio"
              v-bind:id="answer.id"
              v-bind:value="answer.id"
              v-model="addradio"
            />
            <label for="one">{{ answer.answer }}</label
            ><br />
          </span>
        </span>

        <button v-on:click="addanswer">Записать значение</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      addradio: 0, // переменная задает верный ответ
      url_answer: [],
      url_question: "",
      recorded: "",
      counter: 0,
      numer: 1,
      last: "888888",
    };
  },
  mounted() {
    this.update();
    //this.addanswer();
  },
  methods: {
    update: function () {
      this.run_test();
    },
    addanswer: function () {
      const data_form = {
        id_test: this.addradio,
      };

      axios.post("/add_answer", data_form).then((response) => {
        console.log(response.data.url_answer);
        this.recorded = response.data.url_recorded;
      });
    },
    more: function () {
      this.numer += 1;
      this.recorded="";
      this.run_test();
    },
    less: function () {
      this.numer -= 1;
      this.recorded="";
      this.run_test();
    },

    run_test: function () {
      console.log("run_test");
      const data_form = {
        //lastname: this.lastname,
        last_post: "9999",
        numer_post: this.numer,
      };

      axios.post("/edit_test", data_form).then((response) => {
        //axios.post("/run_test").then(response => {
        //console.log(response.data.url_addradio);
        this.addradio = response.data.url_addradio;
        this.url_answer = response.data.url_answer;
        this.url_question = response.data.url_question;
        //console.log(response.data.url_answer);
        //console.log(response.data.url_strok);
        //this.url_categorie[]="";
        //this.clearform();
      });
    },
  },
};
</script>