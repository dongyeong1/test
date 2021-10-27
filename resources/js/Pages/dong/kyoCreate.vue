<template>
  <app-layout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="onSubmitForm">
              <div class="mb-4">
                <label class="text-xl text-gray-600"
                  >className <span class="text-red-500">*</span></label
                ><br />
                <input
                  v-model="className"
                  type="text"
                  class="border-2 border-gray-300 p-2 w-full"
                  name="className"
                  id="className"
                  required
                />
                <label class="text-xl text-gray-600"
                  >classGrade <span class="text-red-500">*</span></label
                ><br />
                <input
                  v-model="classGrade"
                  type="number"
                  class="border-2 border-gray-300 p-2 w-full"
                  name="classGrade"
                  id="classGrade"
                  required
                />
              </div>

              <div class="mb-8">
                <label class="text-xl text-gray-600"
                  >aboutClass <span class="text-red-500">*</span></label
                ><br />
                <textarea
                  v-model="aboutClass"
                  name="aboutClass"
                  class="border-2 border-gray-500"
                >
                </textarea>
              </div>

              <div class="flex p-1">
                <button
                  role="submit"
                  class="p-3 bg-blue-500 text-white hover:bg-blue-400"
                  required
                >
                  등록
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";
export default {
  components: {
    AppLayout,
  },
  data() {
    return {
      className: "",
      classGrade: 0,
      aboutClass: "",
    };
  },
  methods: {
    onSubmitForm() {
      axios
        .post("/create", {
          className: this.className,
          classGrade: this.classGrade,
          aboutClass: this.aboutClass,
        })
        .then(() => {
          alert("등록성공");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
