<template>
  <div class="container">
    <div v-if="numer_testa === 0">
      <div class="row">
        <span>
          <div class="col-sm">
            <input type="radio" id="1" value="1" v-model="choice" />
            <label for="one">Охрана труда</label>
          </div>

          <div class="col-sm">
            <input type="radio" id="2" value="2" v-model="choice" />
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
            <button class="btn btn-info" @click="view_compl">
              Просмотр выполненных
            </button>
            <button class="btn btn-outline-danger" @click="reset">Сброс</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container" v-if="numer_testa > 0">
      <div class="row">
        <div class="col-8 col-md-4">Время выполнения</div>
        <div class="col-8 col-md-4">
          Вопрос № {{ numer_testa }} из {{ all_quest }}
        </div>
        <div class="col-8 col-md-4">
          <button class="btn btn-success" @click="minus">-</button>
          <button class="btn btn-success" @click="plus">+</button>
        </div>

        <span>
          <div class="col-sm"></div>
        </span>
      </div>
      <span>
        <div>
          <div v-for="(lists, index) in list" :key="lists.id">
            <div class="alert alert-danger" role="alert" v-if="index === 0">
              <strong> {{ lists.qu_an }}"<br /> </strong>
            </div>
            <span v-if="index > 0">
              <label
                ><div class="alert alert-warning" role="alert">
                  {{ index }}
                  <input
                    type="radio"
                    v-bind:value="lists.id"
                    v-model="answer"
                  />
                  <strong>
                    {{ lists.qu_an }}
                  </strong>
                </div>
              </label>
            </span>
          </div>
        </div>

        <div class="col-sm right">
          <div id="example-2">
            <button class="btn btn-success" @click="save_answer">
              Сохранить ответ
            </button>
          </div>
          <div class="alert alert-danger" role="alert" v-if="errors != 0">
            <strong> {{ errors }}</strong>
          </div>
        </div>
      </span>
    </div>
    <div class="container" v-if="view_tabl > 0">
      <div class="row">
        <div class="col">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Дата выполнения</th>
                <th>Результат %</th>
                <th>Просмотр ответов</th>
              </tr>
            </thead>
            <tbody>
              <tr scope="row" v-for="(views, index) in view" :key="views.id">
                <th>{{ index + 1 }}</th>
                <td>{{ views.date }}</td>
                <td>
                  <b>
                    <font v-if="views.result >= percent" color="SeaGreen">{{
                      views.result
                    }}</font>
                    <font v-else color="FireBrick">{{ views.result }}</font></b
                  >
                </td>
                <td>
                  <button
                    type="button"
                    class="btn btn-link"
                    @click="swon_result(views.id)"
                  >
                    Посмотреть результат
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="text-center">
            <button class="btn btn-outline-dark" center @click="more">
              Ещё
            </button>
          </div>
          <div class="container" v-if="view_tabl > 0">
            <div class="row">
              <div class="col">
                <Span v-for="item in result_test" :key="item.id">
                  <span v-if="item.date > '2021-01-01'"
                    ><b> {{ item.variant }}. {{ item.qu_an }} </b><br
                  /></span>
                  <span v-else>
                    <span
                      v-if="item.right === '1'"
                      style="background-color: #f5f5dc; color: #66bc29"
                    >
                      {{ item.qu_an }}<br />
                    </span>
                    <span
                      v-else-if="(item.an_user === '1') & (item.right === '0')"
                      style="background-color: #fff5ee; color: #ff6347"
                    >
                      {{ item.qu_an }}<br />
                    </span>
                    <span v-else>{{ item.qu_an }}<br /></span>
                  </span>
                </Span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      numer_testa: 0, //исправить на ноль после отладки номер вопроса самая основная переменная
      all_quest: 0, //исправить на ноль после отладки всего вопросов
      summar_id: 0, //исправить на ноль после отладки всего вопросов
      counter: 0,
      choice: "1",
      last: "888888",
      list: [],
      errors: "0",
      ass: [],
      arr_answer: [],
      answer_radio: "",
      answer: null,
      view: [],
      views: [],
      view_tabl: 0,
      take: 2,
      percent: 40, // процент выполнения
      result_test: [],
      //data_form:0,
    };
  },
  mounted() {
    // this.update();
    axios.post("/all_quest").then((response) => {
      this.all_quest = response.data.url_all_quest;
      this.percent = response.data.url_percent;
    });
  },
  methods: {
    minus: function () {
      if (this.numer_testa > 1) {
        this.numer_testa--;
        this.errors = "";
      }
      this.update_post(this.numer_testa);
    },
    plus: function () {
      if (this.numer_testa < this.all_quest) {
        this.numer_testa++;
        this.errors = "";
      }
      this.update_post(this.numer_testa);
    },

    run_test: function () {
      this.post_run_test();
      this.numer_testa++;
    },
    save_answer: function () {
      if (this.answer == null) {
        //сообщение об ошибки
        this.errors = "Выберите ответ";
      } else {
        const data_form = {
          rezult_id: this.answer,
          numer_testa: this.numer_testa,
          all_quest: this.all_quest,
          summar_id: this.summar_id,
        };
        axios.post("/add_rezult", data_form).then((response) => {
          this.numer_testa = response.data.numer_testa;
          if (this.numer_testa > 0) {
            console.log("numer voprosa=" + response.data.numer_testa);
            this.update_post(response.data.numer_testa);
          }

          this.all_quest = response.data.all_quest;
          this.summar_id = response.data.summar_id;
          this.errors = response.data.url_errors;
        });
      }
    },
    post_run_test: function () {
      this.result_test = [];
      this.view = [];
      this.views = [];
      this.view_tabl = 0;
      const data_form = {
        choice_post: this.choice, // выбор номера теста задания
        numer_testa: this.numer_testa,
        all_quest: this.all_quest,
        summar_id: this.summar_id,
      };

      axios.post("/run_test", data_form).then((response) => {
        this.all_quest = response.data.url_all_quest;
        this.summar_id = response.data.url_summar_id;
        this.list = response.data.url_odin_quest; // массив вопросов
        this.answer = response.data.url_answer;
      });
    },
    //повторяющаяся функция
    update_post: function (numer_ans) {
      const data_form = {
        choice_post: this.choice, // выбор номера теста задания
        numer_testa: numer_ans,
        all_quest: this.all_quest,
        summar_id: this.summar_id,
      };
      axios.post("/run_test", data_form).then((response) => {
        this.all_quest = response.data.url_all_quest;
        this.summar_id = response.data.url_summar_id;
        this.list = response.data.url_odin_quest; // массив вопросов
        this.answer = response.data.url_answer;
      });
    },
    view_compl: function () {
      const data_form = {
        choice: this.choice,
        take: this.take, // выбор номера теста задания
      };
      axios.post("/view_compl", data_form).then((response) => {
        this.view = response.data.url_view;
      });
      this.view_tabl = 1;
    },

    more: function () {
      this.take = this.take + 2;
      this.result_test = [];
      this.view_compl();
    },
    swon_result: function (rezult_id) {
      console.log(rezult_id);
      this.result_test = [];
      const data_form = {
        rezult_id: rezult_id,
      };
      axios.post("/swon_result", data_form).then((response) => {
        this.result_test = response.data.url_result_test;
        // this.view = response.data.url_view;
      });
      // console.log(this.result_test);
    },
    reset: function () {
      this.result_test = [];
      this.view= [];
      this.view_tabl= 0;
    },

  },
};
 //   var second=15;
   //     function tiktak()
  //      {
   //       if(second<=9){second="0" + second;}
   //       if(document.getElementById){timer.innerHTML=second;}
   //       if(second==00){return false;}
   //       second--;
    //      setTimeout("tiktak()", 1000);
    //    }
</script>