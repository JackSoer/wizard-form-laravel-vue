<template>
  <div class="memeber-form-second">
    <MyInput
      v-for="input in inputDataSecond"
      :label="input.label"
      :key="input.id"
      v-bind="input"
      :model-value="member[input.name]"
      @update:model-value="changeMember"
      :errors="validator[input.name].$errors"
      @blur="validator[input.name].$touch"
      :autofocused="input.name === 'company' && !onlyEdit ? true : false"
    />
    <MyTextarea
      label="About Me"
      id="aboutMe"
      name="aboutMe"
      :model-value="member.aboutMe"
      @update:model-value="changeMember"
      max-lenght="2000"
      :errors="validator.aboutMe.$errors"
      @blur="validator.aboutMe.$touch"
    />
    <FileInput
      label="Photo"
      id="photo"
      name="photo"
      accept="image/*"
      :model-value="member.photo"
      @update:model-value="changeMember"
      :maxMb="5"
      :allowedTypes="['image/']"
      @errors="handlePhotoErrors"
    />
  </div>
</template>
<script>
import FileInput from "@/components/FileInput.vue";
import inputData from "@/data/inputData";
import { mapState, mapMutations } from "vuex";
import { ref } from "vue";

export default {
  components: {
    FileInput,
  },
  props: {
    requestErrors: {
      type: [Object, null],
      default: null,
    },
    onlyEdit: {
      type: Boolean,
      default: false,
    },
    validator: {
      type: Object,
      required: true,
    },
  },
  setup() {
    const inputDataSecond = inputData.secondPart;
    const photoErrors = ref([]);

    return {
      inputDataSecond,
      photoErrors,
    };
  },
  methods: {
    ...mapMutations({
      changeMemberField: "member/changeMemberField",
    }),
    changeMember(value, field) {
      this.changeMemberField({ field, value });
    },
    handlePhotoErrors(errors) {
      this.photoErrors = errors;
    },
  },
  computed: {
    ...mapState({
      member: (state) => state.member.member,
    }),
  },
  watch: {
    photoErrors() {
      this.$emit("photoErrors", this.photoErrors);
    },
  },
};
</script>
<style lang="scss" scoped>
.memeber-form-second {
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 10px;
}
</style>
