import { createMuiTheme } from "@material-ui/core";

export default createMuiTheme({
   overrides: {
       MuiButton: {
           root: {
               fontWeight: "bold",
               backgroundColor: "red",
               margin: "10px",
               "&:hover": {
                   backgroundColor: "green"
               }
           }
       }
   }
});
