import { createSlice } from '@reduxjs/toolkit';

let nextTodoId=0;

const todosSlice= createSlice({
    name: 'todos',
    initialState: [],
    tasks: [],
    deletedTasks: [], // Nouvelle liste pour les tâches supprimées
 
    reducers: {
        addTodo(state, action){
            state.push({id: nextTodoId++, text: action.payload, completed: false})
        },
        deleteTodo: (state, action) => {
            const idToDelete = action.payload;
            return state.filter((todo) => todo.id !== idToDelete);
           
          },
          editTodo: (state, action) => {
            const { id, text } = action.payload;
            const todoToEdit = state.find((todo) => todo.id === id);
            if (todoToEdit) {
              todoToEdit.text = text;
            }
          },
          updateTaskList: (state, action) => {
            return action.payload; // Remplacez l'état par la liste des tâches mise à jour
          },
        toggleTodo(state, action){
            const todo= state.find(todo=> todo.id=== action.payload)
            if(todo){
                todo.completed=!todo.completed
            }
        }
    }
})

export const { addTodo, toggleTodo, deleteTodo, editTodo, updateTaskList}= todosSlice.actions

export default todosSlice.reducer