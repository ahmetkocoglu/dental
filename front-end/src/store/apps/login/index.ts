// ** Redux Imports
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit'

// ** Axios Imports
import axios from 'axios'

// ** Config
import authConfig from '../../../service/config'

// ** Login User
export const login = createAsyncThunk('loginUser/fetchData', async (payload: any) => {
    const response = await axios.post(authConfig.loginEndpoint, payload)

    return response.data
})

export const appUsersSlice = createSlice({
    name: 'appUsers',
    initialState: {
        data: [],
        isTestLoading: 'idle',
        isLoginLoading: 'idle',
        loginErrorMessage: ""
    },
    reducers: {},
    extraReducers: builder => {
        builder.addCase(login.pending, (state) => {
            state.isLoginLoading = 'pending'
        })
        builder.addCase(login.fulfilled, (state, action) => {
            if (action.payload.status){
                state.isLoginLoading = 'succeeded'
                state.data = action.payload.data
            } else {
                state.isLoginLoading = 'failed'
                state.loginErrorMessage = action.payload.message
            }
        })
        builder.addCase(login.rejected, (state, action) => {
            state.isLoginLoading = 'failed'
            state.loginErrorMessage = "sunucu hatası"
        })
    }
})

export default appUsersSlice.reducer
