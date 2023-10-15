import { Company } from "~/types/company";
import { GET } from "~/constants/http";
import useAppFetch from "~/composables/useAppFetch";

export default async function useListUsers() {
  return useAppFetch<Array<Company>>(() => "/companies", {
    key: "listCompanies",
    method: GET,
  });
}
