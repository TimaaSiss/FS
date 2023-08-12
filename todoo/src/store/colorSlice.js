import { createSlice } from "@reduxjs/toolkit";

const initialState = {
 colors, generated, value: [],
};

//A function to generate random RGB values
const randomRgb = () => {
  const red = Math.floor(Math.random() * 256);
  const green = Math.floor(Math.random() * 256);
  const blue = Math.floor(Math.random() * 256);

  return `rgb(${red}, ${green}, ${blue})`;
};

//State slice
export const colorSlice = createSlice({
  name: "color",
  initialState,
  reducers: {
    setColor: (state) => {
      state.value = [...state.value, randomRgb()];
    },
  },
});

// Action creators are automatically generated for each case reducer function 
export const { setColor } = colorSlice.actions;

export default colorSlice.reducer;