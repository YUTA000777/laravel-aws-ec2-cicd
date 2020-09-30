<template>
  <div>
    <strong>いいね！</strong>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="fas fa-heart mr-1"
         :class="{'red-text':this.isLikedBy}"
         @click="clickLike"
      />
      <!-- v-on:clickでハートを動かす -->
      <!-- isLikedByがtrueである時にハートを赤く表示する。-->
    </button>
    {{ countLikes }}
  </div>
</template>

<script>
  export default {
    props: {
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
      }
    },
    methods: {
      clickLike() {
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }
        this.isLikedBy
          ? this.unlike()
          : this.like()
      },
      async like() {
        const response = await axios.put(this.endpoint)
        this.isLikedBy = true//isLikedByにtrueを代入して、この結果ハートアイコンが赤くなる。
        this.countLikes = response.data.countLikes//レスポンスのボディ部には、Laravel側のlikeアクションメソッドの戻り値が代入される（HTTP通信の結果が代入される）
        
      },
      async unlike() {
        const response = await axios.delete(this.endpoint)
        this.isLikedBy = false
        this.countLikes = response.data.countLikes
        
      },
    },
  }
</script>