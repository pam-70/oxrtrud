<template>
  <div class="container">
    <div class="row">
      <span>
        <div class="col-sm">
          <input type="radio" id="one" value="1" v-model="choice" />
          <label for="one">Охрана труда</label>
        </div>

        <div class="col-sm">
          <input type="radio" id="two" value="2" v-model="choice" />
          <label for="two">Электробезопасность</label>
        </div>
      </span>
    </div>

    <div class="row">
      <div class="col-sm">
        <div id="example-1">
          <button class="btn btn-success" v-on:click="run_test">
            Выполнить тест
          </button>
        </div>
      </div>
      <div class="col-sm"></div>
      <div class="col-sm right">
        <div id="example-2">
          <button class="btn btn-info">Просмотр выполненных</button>
        </div>
        <ul id="example-1">
          <li v-for="lists in list" :key="lists.id">
            {{ lists.id }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      numer_testa: 1, //исправить на ноль после отладки номер вопроса самая основная переменная
      all_quest: 10, //исправить на ноль после отладки всего вопросов
      summar_id: 12, //исправить на ноль после отладки всего вопросов
      counter: 0,
      choice: "1",
      last: "888888",
      list: [],
    };
  },
  mounted() {
    // this.update();
  },
  methods: {
    run_test: function () {
      console.log("run_test");
      const data_form = {
        //lastname: this.lastname,
       
        choice_post: this.choice,// выбор номера теста задания

        numer_testa: this.numer_testa,
        all_quest: this.all_quest,
        summar_id: this.summar_id,
      };

      axios.post("/run_test", data_form).then((response) => {
        //axios.post("/run_test").then(response => {
        //console.log(response.data.url_klasse);
        //this.url_listt = response.data.url_listt;
        this.numer_testa = response.data.url_numer_testa;
        this.all_quest = response.data.url_all_quest;
        this.summar_id = response.data.url_summar_id;
        console.log(this.numer_testa);
        console.log(this.all_quest);
        console.log(this.summar_id);
        console.log(response.data.url_odin_quest);


        //console.log(response.data.url_listt);
        //console.log(response.data.url_strok);
        //this.url_categorie[]="";
        //this.clearform();
      });
    },
  },
};
</script>