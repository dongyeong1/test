<template>
  <jet-dialog-modal :show="showOpen">
    <template #title> 상세보기 </template>
    <template #content>
      <div v-for="content in showcontents" :key="content.id">
        <!-- 사용자:{{ content.user.name }}<br /> -->
        과목명:{{ content.className }}<br />
        설명:{{ content.aboutClass }}<br />
        학점:{{ content.classGrade }}<br />
        등록일:{{ content.created_at }}<br />
        변경일:{{ content.updated_at }}<br />
        <button v-if="su" @click="sugang">수강신청</button>
        <button v-if="!su" @click="sugangcancel">수강취소</button>
      </div>
      <hr />

      <div>*수정하기*</div>
      과목명:<input
        type="text"
        v-model="updatedClassName"
        placeholder="과목명을 입력해주세요"
      /><input /> <br />
      설명:<input
        type="text"
        v-model="updatedAboutClass"
        placeholder="설명을 입력해주세요"
      />
      <input /><br />
      학점:<input
        type="number"
        v-model="updatedClassGrade"
        placeholder="학점을 입력해주세요"
      /><input />
      <button @click="update(this.contentsId)">수정하기</button>
      <button @click="deletes(this.contentsId)">삭제하기</button>
      <button @click="$emit('closemodal')">취소</button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
export default {
  props: ["showOpen", "contentsId", "showcontents"],
  components: {
    JetDialogModal,
  },
  data() {
    return {
      su: true,
      updatedClassName: "",
      updatedClassGrade: 0,
      updatedAboutClass: "",

      contents: [],
    };
  },
  methods: {
    sugang() {
      this.su = false;
    },
    sugangcancel() {
      this.su = true;
    },
    deletes(postId) {
      if (confirm("진짜삭제할꺼야?")) {
        this.postDelete(postId);
      }
    },
    postDelete(postId) {
      axios
        .post("/delete", {
          postId,
        })
        .then((res) => {
          alert("삭제완료");

          this.$emit("updated");
          this.$emit("closemodal");
        })
        .catch((err) => {
          console.log(err);
        });
    },
    update(postId) {
      axios
        .post("/update", {
          postId,
          updatedClassName: this.updatedClassName,
          updatedClassGrade: this.updatedClassGrade,
          updatedAboutClass: this.updatedAboutClass,
        })
        .then(() => {
          alert("수정성공");

          this.$emit("updated");
          this.$emit("closemodal");
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getShowContent() {
      axios
        .post("/getShowContent", {
          contentId: this.contentId,
        })
        .then((res) => {
          console.log("dog");
          console.log(res.data);
          this.contents = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {},
};
</script>