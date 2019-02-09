<template>
  <div class="card card-plain">
    <div role="tab" id="headingOne" class="card-header">
      <a
        data-toggle="collapse"
        data-parent="#accordion"
        :href="`#${itemId}`"
        @click.prevent="activate"
        :aria-expanded="active"
        :aria-controls="`content-${itemId}`"
      >
        <slot name="title">{{ title }}</slot>
        <i class="tim-icons icon-minimal-down"></i>
      </a>
    </div>

    <div
      v-show="active"
      :id="`content-${itemId}`"
      role="tabpanel"
      :aria-labelledby="title"
      class="collapsed"
    >
      <div class="card-body">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "collapse-item",
  components: {},
  props: {
    title: {
      type: String,
      default: ""
    },
    id: String
  },
  inject: {
    animationDuration: {
      default: 250
    },
    multipleActive: {
      default: false
    },
    addItem: {
      default: () => {}
    },
    removeItem: {
      default: () => {}
    },
    deactivateAll: {
      default: () => {}
    }
  },
  computed: {
    itemId() {
      return this.id || this.title;
    }
  },
  data() {
    return {
      active: false
    };
  },
  methods: {
    activate() {
      console.log("ss");
      let wasActive = this.active;
      if (!this.multipleActive) {
        this.deactivateAll();
      }
      this.active = !wasActive;
    }
  },
  mounted() {
    this.addItem(this);
  },
  destroyed() {
    if (this.$el && this.$el.parentNode) {
      this.$el.parentNode.removeChild(this.$el);
    }
    this.removeItem(this);
  }
};
</script>
<style>
</style>
