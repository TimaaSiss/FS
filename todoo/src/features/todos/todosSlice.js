import { createSlice } from "@reduxjs/toolkit";

const todosSlice = createSlice({
  name: "todos",
  initialState: {
    tasks: [],
  },

  reducers: {
    setTodos:(state, action) =>{
      state.tasks = action.payload;
      console.log(state.tasks);
    },
    addTodo : (state, action)=> {
      const { id, text } = action.payload;
      state.tasks.push({
        id,
        text,
        completed: false,
      });
    },
    deleteTodo: (state, action) => {
      const idToDelete = action.payload.id; // Accédez à l'id depuis l'action payload
      state.tasks = state.tasks.filter((todo) => todo.id !== idToDelete);
    },
    editTodo: (state, action) => {
      const { id, text, status } = action.payload;
      const todoToEdit = state.tasks.find((todo) => todo.id === id);
      if (todoToEdit) {
        todoToEdit.text = text;
        todoToEdit.status = status;
      }
    },
  },
});

export const { addTodo, toggleTodo, deleteTodo, editTodo, setTodos } =
  todosSlice.actions;

export default todosSlice.reducer;
