<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="btn btn-link" @click="lists">
              Список работников
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="btn btn-link" @click="currentTab = 'passed'">
              Сдали
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="btn btn-link" @click="currentTab = 'Installations'">
              Установки
            </button>
          </li>
        </ul>
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="tab-content">
                <div v-if="currentTab == 'lists'">
                  <select v-model="selected">
                    <option
                      v-for="istitut in istitutation"
                      :key="istitut.id"
                      v-bind:value="istitut.id"
                    >
                      {{ istitut.name }}
                    </option>
                    >
                  </select>

                  <button
                    type="button"
                    class="btn btn-primary btn-sm"
                    @click="showlist"
                  >
                    Показать список работников
                  </button>
                  <input type="checkbox" value="1" v-model="asc" />
                  <label>По алфавиту</label>
                  <input type="checkbox" value="1" v-model="del" />
                  <label>Архив</label>

                  <button
                    type="button"
                    class="btn btn-primary btn-sm"
                    data-toggle="modal"
                    data-target=".bd-example-modal-sm"
                    @click="namebat"
                  >
                    +
                  </button>
                  <a
                    :href="`/print_user?istitut_ids=${istitut_id}`"
                    target="_blank"
                    >Печать логинов и паролей</a
                  >
                  <div class="col-sm-2">
                    <input
                      type="text"
                      aria-label="First name"
                      class="form-control form-control-sm"
                      placeholder="фильтр по фамилии"
                      v-model="lastin"
                      v-on:keyup="filtersurname()"
                    />
                  </div>
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

                  <div class="container">
                    <div class="row">
                      <div class="col">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Фамилия имя отчество</th>
                              <th>Логин</th>
                              <th>Пароль</th>
                              <th>Редактировать</th>
                              <th>Результат</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              scope="row"
                              v-for="(institutions, index) in institution"
                              :key="institutions.id"
                            >
                              <th>{{ index + 1 }}</th>
                              <td>{{ institutions.surname }}</td>
                              <td>{{ institutions.name }}</td>
                              <td>{{ institutions.password_srt }}</td>
                              <td>
                                <button
                                  type="button"
                                  class="btn btn-link"
                                  data-toggle="modal"
                                  data-target=".bd-example-modal-sm"
                                  @click="swon_user(institutions.id)"
                                >
                                  Редактировать
                                </button>
                              </td>
                              <td>
                                <button
                                  type="button"
                                  class="btn btn-link"
                                  @click="admin_result(institutions.id)"
                                >
                                  Результат
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>

                        <div class="col">
                          Таблица результатов одного сотрудника
                          <table class="table table-striped">
                            <tbody>
                              <tr
                                scope="row"
                                v-for="(rezults, index) in rezult"
                                :key="rezults.id"
                              >
                                <th>{{ index + 1 }}</th>
                                <td>{{ surnameres }}</td>
                                <td>{{ rezults.date }}</td>
                                <td>{{ rezults.result }}</td>
                                <td>
                                  <a
                                    :href="`/print_result?summarie_ids=${rezults.id}`"
                                    target="_blank"
                                    >Печать билета с ответами</a
                                  >
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="currentTab == 'passed'">Сдали тест</div>
          <div v-if="currentTab == 'Installations'">Установки страница</div>
        </div>
      </div>
    </div>
    <div
      class="modal fade bd-example-modal-sm"
      tabindex="-1"
      role="dialog"
      aria-labelledby="mySmallModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-footer">
            <div class="input-group input-group-sm mb-3">
              <input
                type="text"
                class="form-control"
                aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm"
                v-model="surname"
              />
            </div>
            <div class="input-group input-group-sm mb-3">
              <select v-model="selected">
                <option
                  v-for="istitut in istitutation"
                  :key="istitut.id"
                  v-bind:value="istitut.id"
                >
                  {{ istitut.name }}
                </option>
                >
              </select>
              <div class="form-check">
                <input type="checkbox" value="1" v-model="del" />
                <label>В архив</label>
              </div>
            </div>

            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Отмена
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              :v-model="bat"
              @click="addlist"
            >
              {{ bat }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
//import jspdf from 'jspdf';
export default {
  data: function () {
    return {
      currentTab: "lists",
      istitutation: [],
      selected: "",
      institution: [],
      surname: "",
      surnameres: "",
      asc: 1,
      del: 0,
      bat: "Сохранить",
      user_id: "",
      choice: 1,
      rezult: [],
      lastin: "",
      fsurname: "",
      html: "",
      istitut_id:"",
    };
  },
  mounted() {
    // this.selectedLang = this.items[0].value;
    this.update();
    //this.addanswer();
  },
  methods: {
    print_result: function (rez_id) {
      console.log(rez_id);
      const data_form = {
        id_result: rez_id,
      };
      axios.get("/print_result", data_form).then((response) => {
        // console.log(response.data.url_i);
      });
    },
    filtersurname: function () {
      const data_form = {
        id_institution: this.selected,
        asc: this.asc,
        del: this.del,
        surname: this.lastin,
      };
      axios.post("/filter_surname", data_form).then((response) => {
        this.institution = response.data.url_institution;
      });
    },

    admin_result: function (id) {
      const data_form = {
        user_id: id,
        choice: this.choice,
      };
      axios.post("/admin_result", data_form).then((response) => {
        // console.log(response.data.url_surnameres);
        this.rezult = response.data.url_rezult;
        this.surnameres = response.data.url_surnameres;
        //this.surname = response.data.url_user;
      });
    },
    swon_user: function (id) {
      this.bat = "Сохранить";
      this.user_id = id;
      const data_form = {
        user_id: id,
      };
      axios.post("/swon_user", data_form).then((response) => {
        this.user_id = response.data.url_user_id;
        this.surname = response.data.url_user;
      });
    },
    addlist: function () {
      if (this.bat === "Добавить") {
        const data_form = {
          id_institution: this.selected,
          surname: this.surname,
        };
        axios.post("/add_user", data_form).then((response) => {});
      }
      if (this.bat === "Сохранить") {
        //console.log("Сработало сохранить");
        const data_form = {
          id_institution: this.selected,
          surname: this.surname,
          del: this.del,
          user_id: this.user_id,
        };
        axios.post("/updat_user", data_form).then((response) => {});
      }
      this.showlist();
    },
    namebat: function () {
      this.bat = "Добавить";
    },

    update: function () {
      axios.post("/adm_updat").then((response) => {
        this.istitutation = response.data.url_istitutation;
      });
    },
    showlist: function () {
      this.istitut_id=this.selected;
      const data_form = {
        id_institution: this.selected,
        asc: this.asc,
        del: this.del,
      };
      axios.post("/show_list", data_form).then((response) => {
        this.institution = response.data.url_institution;
      });
    },
    lists: function () {
      this.currentTab = "lists";
    },
  },
};
</script>