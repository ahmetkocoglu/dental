import {useDispatch, useSelector} from "react-redux";
import {AppDispatch, RootState} from "../store";
import {useEffect} from "react";
import {fetchTreatmentData} from "../store/apps/treatment";

function Treatment() {
    // ** Redux
    const dispatch = useDispatch<AppDispatch>()

    // ** Selector
    const isLoading: string = useSelector((state: RootState) => state.treatment.isLoading)
    const data: never[] = useSelector((state: RootState) => state.treatment.data)

    useEffect(() => {
        dispatch(fetchTreatmentData())
    }, [])

    return (
        <>
            {isLoading === 'pending' &&
                (
                    <div>veriler alınıyor</div>
                )}
            {isLoading === 'succeeded' &&
                (
                    <>
                        <table>
                            <thead>
                            <tr>
                                <th>Tedavi Adı</th>
                            </tr>
                            </thead>
                            <tbody>
                            {data.map((k: any, i: number) => {
                                return <tr key={i}>
                                    <td>{k.name}</td>
                                </tr>
                            })}
                            </tbody>
                        </table>
                    </>
                )}
        </>
    );
}

export default Treatment
