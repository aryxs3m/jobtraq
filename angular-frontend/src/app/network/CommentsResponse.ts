import {Comment} from "./Comment";

export interface CommentsResponse {
  status: string;
  data: Comment[]
}
