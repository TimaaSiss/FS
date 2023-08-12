import React, { useState } from "react";
import { View, StyleSheet , FlatList, ScrollView, Text} from "react-native";
import { useSelector, useDispatch } from "react-redux";
import {Addtodo  } from "./AddTodo";

export function TodoList(){
    const todos = useSelector((state)=> state.todos);

    console.log(todos);

    return(
        <View style={styles.container}>
           <Addtodo />
           <ScrollView style={{height:"100%"}}>
                <FlatList 
                style={{height:"100%"}}
                data={todos}
                renderItem={({item})=>  <Text>{item.text}</Text> }
                />
           </ScrollView>
        </View>
    );
    
}

const styles= StyleSheet.create({
    container: {
        margin:12,
        flex:1,
    },
    title: {
        fontSize:16,
        fontWeight:"bold",
    },
    todoText: {
        margin:4,
    }

})