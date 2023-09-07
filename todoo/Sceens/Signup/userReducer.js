const initialState = { username: '', email: '', };
  
  const userReducer = (state = initialState, action) => {
    switch (action.type) {
      case 'username, email':
        return {
          ...state,
          ...action.payload,
        };
      default:
        return state;
    }
  };
  
  export default userReducer;
  