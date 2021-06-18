import React from "react";
import { useFormContext, Controller } from "react-hook-form";
import TextField from "@material-ui/core/TextField";

function FormTextInput(props) {
    const { control } = useFormContext();
    const { name, label } = props;

    return (
        <Controller
            name={name}
            control={control}
            defaultValue=""
            label={label}
            variant="outlined"
            {...props}
            render={({field}) => (
                <TextField
                    {...field}
                    {...props}
                />
            )}
        />
    );
}

export default FormTextInput;
