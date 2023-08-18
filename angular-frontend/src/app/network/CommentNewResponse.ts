import {NewsBlockItem} from "./NewsBlockItem";

export interface CommentNewResponse {
  status: string;
  data: {
    id: number;
    status: string;
  }
}
