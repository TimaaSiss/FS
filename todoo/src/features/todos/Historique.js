import React from "react";
import { View, StyleSheet, FlatList, Text } from "react-native";
import { useSelector } from "react-redux";

export function Historique() {
  // Utilisez le Redux useSelector pour obtenir la liste complète de tâches
  const tasks = useSelector((state) => state.todos.tasks); // Accédez à la propriété tasks

  // Filtrer les tâches terminées et en cours
  const completedTodos = tasks.filter((todo) => todo.completed);
  const inProgressTodos = tasks.filter((todo) => !todo.completed);
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Historique des Tâches en Cours</Text>
      <FlatList
        data={inProgressTodos}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => (
          <View style={styles.taskItem}>
            <Text style={styles.taskText}>{item.text}</Text>
          </View>
        )}
      /> 
      <Text style={styles.title}>Historique des Tâches Terminées</Text>
      <FlatList
        data={completedTodos}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => (
          <View style={styles.taskItem}>
            <Text style={[styles.taskText, { textDecorationLine: 'line-through' }]}>
              {item.text}
            </Text>
          </View>
        )}
      />

      
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    margin: 12,
    backgroundColor: "#f2f2f2",
  },
  title: {
    fontSize: 24,
    fontWeight: "bold",
    marginBottom: 20,
  },
  taskItem: {
    backgroundColor: "#fff",
    padding: 10,
    marginBottom: 10,
    borderRadius: 5,
    borderColor: "#ccc",
    borderWidth: 1,
  },
  taskText: {
    fontSize: 16,
  },
});

export default Historique;
