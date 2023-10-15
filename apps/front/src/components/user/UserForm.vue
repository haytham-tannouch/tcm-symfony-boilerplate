<template>
  <div>
    <label for="email">Email</label>
    <input
      type="text"
      :value="email"
      @input="$emit('update:email', clearInput($event))"
    />
  </div>
  <div>
    <label for="profilePicture">Profile Picture</label>
    <input
      type="file"
      accept="image/*"
      @input="onSelectFile"
    />
  </div>
  <div>
    <label for="password">Password</label>
    <input
      name="password"
      type="password"
      :value="password"
      @input="$emit('update:password', clearInput($event))"
    />
  </div>
  <div>
    <label for="passwordConfirm">Confirm password</label>
    <input
      name="passwordConfirm"
      type="password"
      :value="passwordConfirm"
      @input="$emit('update:passwordConfirm', clearInput($event))"
    />
    <span v-if="!isPasswordConfirmed" class="text-danger">
      The confirm password is not the same as the password
    </span>
  </div>
</template>
<script setup lang="ts">
import { User } from "~/types/user";

defineProps<
  Omit<User, "id"> & {
    isPasswordConfirmed: boolean;
    password: string;
    passwordConfirm: string;
    profilePictureFile: string | undefined;
  }
>();

interface EventEmitter {
  (e: "update:email", email: string): void;
  (e: "update:password", password: string): void;
  (e: "update:passwordConfirm", passwordConfirm: string): void;
  (e: "update:profilePictureFile", pictureFile: File|null): void;
}

const emit = defineEmits<EventEmitter>();

const onSelectFile = ($event) => {
  const target = $event.target as HTMLInputElement;
  if (target && target.files) {
    emit('update:profilePictureFile', target.files[0])
  }
}

const clearInput = (inputEvent: Event) => {
  return (inputEvent.target as HTMLInputElement)?.value || "";
};
</script>

<style scoped lang="scss"></style>
