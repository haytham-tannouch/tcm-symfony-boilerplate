import {User} from "~/types/user";

export type CompanyId = number;
export interface Company {
  id: ComanyId;
  name: string;
  users: Array<User>;
  identityFile: File|null;

}
