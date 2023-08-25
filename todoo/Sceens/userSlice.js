// userSlice.js
import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  username: "",
  email: "",
  password: "",
  jwt:""
  // Autres champs d'utilisateur que vous pourriez avoir
};

const userSlice = createSlice({
  name: "user",
  initialState,
  reducers: {
    updateUser: (state, action) => {
      const { username, email, jwt } = action.payload;
      state.username = username;
      state.email = email;
      state.jwt= jwt;
    },
    logoutUser: (state) => {
      // Réinitialisez les valeurs utilisateur à l'état initial lors de la déconnexion
      return initialState;
    
    },

  },
});

export const { updateUser, logoutUser } = userSlice.actions;
export default userSlice.reducer;
