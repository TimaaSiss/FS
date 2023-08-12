// src/screens/HomeScreen.js
import React from 'react';
import { Text, View, TouchableOpacity, FlatList } from 'react-native';
import { useDispatch, useSelector } from 'react-redux';
import { setColor } from "../../../store/colorSlice";

const HomeScreen = () => {
    const color = useSelector((state) => state.color.value); //reading the state 
    const dispatch = useDispatch();
  return (
    <View>
      <TouchableOpacity onPress={() => dispatch(setColor())}>
        <Text style={{ fontSize: 20 }}>Generate Random Color</Text>
      </TouchableOpacity>
      <FlatList
        data={color} />
    </View>
  );
};

const styles = {
  button: {
    alignSelf: 'center',
    borderWidth: 1,
    borderRadius: 10,
    padding: 10,
    marginTop: 20,
  },
};

export default HomeScreen;
