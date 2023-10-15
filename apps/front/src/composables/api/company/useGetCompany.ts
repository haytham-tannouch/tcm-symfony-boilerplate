import { GET } from "~/constants/http";
import { User } from "~/types/company";
import useAppFetch from "~/composables/useAppFetch";

export default async function useGetCompany(companyId: string) {
  return useAppFetch<User>(() => "/companies/" + companyId, {
    key: "getCompany",
    method: GET,
  });
}
