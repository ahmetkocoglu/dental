// ** Redux Imports
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit'

// ** Axios Imports
import axios from 'axios'

// ** Config
import authConfig from '../../../service/config'
import {fetchAppointmentData} from "../appointment";

// ** fetch
export const fetchDoctorData = createAsyncThunk('getDoctors/fetchDoctorData', async () => {
    const response = await axios.get(authConfig.doctor)

    return response.data
})

export const appDoctorSlice = createSlice({
    name: 'appDoctors',
    initialState: {
        data: [],
        isLoading: 'idle'
    },
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchDoctorData.pending, (state) => {
            state.isLoading = 'pending'
        })
        builder.addCase(fetchDoctorData.fulfilled, (state, action) => {
            if (action.payload.status){
                state.isLoading = 'succeeded'
                state.data = action.payload.data
            } else {
                state.isLoading = 'failed'
            }
        })
        builder.addCase(fetchDoctorData.rejected, (state) => {
            state.isLoading = 'failed'
        })
    }
})

export default appDoctorSlice.reducer
