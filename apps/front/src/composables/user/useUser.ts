import { User } from "~/types/user";

export default function useUser(user: Ref<User> | undefined = undefined) {
  const password = ref("");
  const passwordConfirm = ref("");
  const email = user ? toRef(user?.value?.email) : ref("");
  const isPasswordConfirmed = computed(
    () => password.value === passwordConfirm.value
  );
  const profilePictureUrl = user ? toRef(user?.value?.profilePictureUrl) : ref("");
  const profilePictureFile = ref<File|null>()

  const isPasswordEmpty = computed(() => !password.value);
  return {
    password,
    passwordConfirm,
    email: email,
    profilePictureUrl,
    profilePictureFile,
    isPasswordConfirmed,
    securedPassword: computed(() =>
      isPasswordConfirmed && isPasswordEmpty ? password.value : ""
    ),
  };
}
