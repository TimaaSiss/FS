import React from "react";
import { View, StyleSheet, Text } from "react-native";
import { TodoList } from "./TodoList";
import { AddTodo } from "./AddTodo";

export const TodoApp=() => {
    return(
        <View style={styles.container}>
            {/* <Text styles={styles.title}></Text> */}
            <AddTodo/>
            <TodoList/>
        </View>
    );
};

const styles= StyleSheet.create({
    title: {
        fontSize: 24,
        fontWeight:"bold",
        marginBottom:12,
    },
    container: {
        flex:1,
        justifyContent: "center",
        alignItems:"center",
        backgroundColor:"white",
    }
})