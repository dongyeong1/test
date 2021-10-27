<template>
  <app-layout>
    <div v-for="(post, k) in posts" :key="k">
      <button @click="showPt(post.id)">{{ post.className }}</button>:{{
        post.classGrade
      }}
    </div>
    <show-post
      :showOpen="showopen"
      :contentsId="ptId"
      :showcontents="postContents"
      v-on:closemodal="close"
      v-on:updated="getList"
    />
    <page-link :links="this.links" />
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";
import PageLink from "@/Pages/dong/links.vue";
import ShowPost from "@/Pages/dong/showPost.vue";

export default {
  props: ["posts"],
  data() {
    return {
      links: [],
      posts: [],
      showopen: false,
      ptId: "",
      postContents: "",
    };
  },
  components: {
    AppLayout,
    PageLink,
    ShowPost,
  },
  methods: {
    showPt(postId) {
      this.showPost(postId);
    },

    close() {
      this.showopen = false;
    },
    showPost(postId) {
      this.showopen = true;
      this.ptId = postId;
      this.getShowContent(postId);
    },
    getShowContent(postId) {
      console.log("dongsik");
      axios
        .post("/getShowPost", {
          postId,
        })
        .then((res) => {
          console.log("dog");
          console.log(res.data);
          this.postContents = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getList() {
      axios
        .post("/get", {})
        .then((res) => {
          console.log(res);
          this.posts = res.data.data;
          this.links = res.data.links;
          console.log(this.posts);
          console.log(this.links);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.getList();
    console.log("asdasdasddddddddddd");
    console.log(this.posts);
  },
};
</script>