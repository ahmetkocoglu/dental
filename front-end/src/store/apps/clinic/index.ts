// ** Redux Imports
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit'

// ** Axios Imports
import axios from 'axios'

// ** Config
import authConfig from '../../../service/config'
import {fetchAppointmentData} from "../appointment";

// ** fetch
export const fetchClinicData = createAsyncThunk('getClinics/fetchClinicData', async () => {
    const response = await axios.get(authConfig.clinic)

    return response.data
})

export const appClinicSlice = createSlice({
    name: 'appClinics',
    initialState: {
        data: [],
        isLoading: 'idle'
    },
    reducers: {},
    extraReducers: builder => {
        builder.addCase(fetchClinicData.pending, (state) => {
            state.isLoading = 'pending'
        })
        builder.addCase(fetchClinicData.fulfilled, (state, action) => {
            if (action.payload.status){
                state.isLoading = 'succeeded'
                state.data = action.payload.data
            } else {
                state.isLoading = 'failed'
            }
        })
        builder.addCase(fetchClinicData.rejected, (state) => {
            state.isLoading = 'failed'
        })
    }
})

export default appClinicSlice.reducer
