// src/store.js
import { configureStore } from '@reduxjs/toolkit';
import todoSliceSlice from "./colorSlice";

export const store = configureStore({
  reducer: {
    todos: todoSlice, 
    user: userReducer,
    },
});


