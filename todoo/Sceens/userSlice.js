// userSlice.js
import { createSlice } from "@reduxjs/toolkit";

const userSlice = createSlice({
  name: "user",
  initialState: {
    username: "",
    email: "",
    // Autres champs d'utilisateur que vous pourriez avoir
  },
  reducers: {
    updateUser: (state, action) => {
      const { username, email } = action.payload;
      state.username = username;
      state.email = email;
    },
    logoutUser: (state) => {
      // Réinitialisez les valeurs utilisateur à l'état initial lors de la déconnexion
      state.username = "";
      state.email = "";
    },
  },
});

export const { updateUser, logoutUser } = userSlice.actions;
export default userSlice.reducer;
