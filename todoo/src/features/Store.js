import { configureStore } from "@reduxjs/toolkit";
import todosSlice from "./todos/todosSlice";
import userSlice from "../../Sceens/userSlice";


export const store = configureStore({
    reducer: {
        todos: todosSlice,
        user: userSlice,
    }


});
export default store;






