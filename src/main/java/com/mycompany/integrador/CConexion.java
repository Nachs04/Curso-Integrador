package com.mycompany.integrador;

import java.sql.Connection;
import java.sql.DriverManager;
import javax.swing.JOptionPane;

/**
 *
 * @author nachs0405
 */
public class CConexion {
    Connection conectar = null;
    String usuario = "root";
    String pass = "admin";
    String bd = "integrador";
    String ip = "localhost";
    String puerto = "3306";
    
    String cadena = "jdbc:mysql://" + ip + ":" + puerto + "/" + bd + "?serverTimezone=UTC";
    
    public Connection estableceConexion(){
        try{
            Class.forName("com.mysql.cj.jdbc.Driver");
            conectar = DriverManager.getConnection(cadena,usuario,pass);
            JOptionPane.showMessageDialog(null, "Conexion se ha realizado con exito");
            
        }catch(Exception e) {
            JOptionPane.showMessageDialog(null,"Error al conectarse a la base de datos, error:"+ e.toString());
        }
        return conectar;
    }
}
