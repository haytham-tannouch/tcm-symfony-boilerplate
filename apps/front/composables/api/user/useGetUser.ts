import { GET } from "~/constants/http";
import { User } from "~/types/user";
import useAppFetch from "~/composables/useAppFetch";

export default async function useGetUser(userId: string) {
  return useAppFetch<User>(() => "/users/" + userId, {
    key: "getUser",
    method: GET,
  });
}
