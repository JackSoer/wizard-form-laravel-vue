<template>
  <div class="my-input">
    <label class="my-input__label" :for="$attrs.id">{{ label }}</label>
    <input
      :type="type"
      class="my-input__item"
      @input="change"
      @keydown="preventLeadingSpaces"
      v-bind="$attrs"
      :value="modelValue"
      :ref="$attrs.name"
    />
    <p class="error" v-for="error in errors" :key="error.$uid">
      {{ error.$message }}
    </p>
    <p
      v-if="!changing && !isLoading"
      class="error"
      v-for="error in requestErrors"
      :key="error"
    >
      {{ error }}
    </p>
  </div>
</template>
<script>
export default {
  name: "MyInput",
  inheritAttrs: false,
  data() {
    return {
      changing: false,
    };
  },
  props: {
    type: {
      type: String,
      default: "text",
    },
    modelValue: {
      type: [String],
      default: "",
    },
    label: {
      type: String,
      default: "",
    },
    errors: {
      type: [Array],
      default: [],
    },
    requestErrors: {
      type: [Array, null],
      default: null,
    },
    nextClickCount: {
      type: Number,
      default: 0,
    },
    isLoading: {
      type: Boolean,
      default: false,
    },
    autofocused: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    change(e) {
      this.changing = true;

      this.$emit("update:modelValue", e.target.value, e.target.name);
    },
    preventLeadingSpaces(e) {
      if (e.key === " " && e.target.selectionStart === 0) {
        e.preventDefault();
      }
    },
  },
  watch: {
    nextClickCount() {
      this.changing = false;
    },
  },
  mounted() {
    if (this.autofocused) {
      this.$refs[this.$attrs.name].focus();
    }
  },
};
</script>
<style lang="scss" scoped>
@import "@/../../scss/var";

.my-input {
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 5px;
  width: 100%;

  &__item {
    box-shadow: 0 0 5px 3px $mainBoxShadow;
    background-color: white;
    outline: none;
    padding: 5px;
    font-size: 18px;
    width: 100%;

    &:focus {
      outline: 1px solid rgb(0, 183, 255);
    }
  }
}
</style>
