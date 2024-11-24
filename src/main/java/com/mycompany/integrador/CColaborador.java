package com.mycompany.integrador;

import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javax.swing.JOptionPane;
import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;
import javax.swing.table.TableRowSorter;

public class CColaborador {
    
    int cod_colaborador;
    String nombre_colaborador;
    String contraseña;
    
    public int getCod_colaborador() {
        return cod_colaborador;
    }

    public void setCod_colaborador(int cod_colaborador) {
        this.cod_colaborador = cod_colaborador;
    }

    public String getNombre_colaborador() {
        return nombre_colaborador;
    }

    public void setNombre_colaborador(String nombre_colaborador) {
        this.nombre_colaborador = nombre_colaborador;
    }

    public String getContraseña() {
        return contraseña;
    }

    public void setContraseña(String contraseña) {
        this.contraseña = contraseña;
    }
    
    // Método para insertar un nuevo colaborador
    public void InsertarColaborador(JTextField paramNombres, JTextField paramContraseña) {
        setNombre_colaborador(paramNombres.getText());
        setContraseña(paramContraseña.getText());
        
        CConexion objConexion = new CConexion();
        String consulta = "INSERT INTO colaborador (nombre_colaborador, contraseña, estado) VALUES (?, ?, 1);";
        
        try {
            CallableStatement cs = objConexion.estableceConexion().prepareCall(consulta);
            cs.setString(1, getNombre_colaborador());
            cs.setString(2, getContraseña());
            cs.execute();
            
            JOptionPane.showMessageDialog(null, "Colaborador insertado correctamente.");
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "No se pudo insertar: " + e.toString());
        }   
    }
    
    // Método para mostrar colaboradores activos
    public void MostrarAlumnos(JTable paramTabla) {
        CConexion objConexion = new CConexion();
        DefaultTableModel modelo = new DefaultTableModel();
        TableRowSorter<TableModel> ordenarTabla = new TableRowSorter<>(modelo);
        paramTabla.setRowSorter(ordenarTabla);
        
        modelo.addColumn("Codigo");
        modelo.addColumn("Nombre");
        modelo.addColumn("Contraseña");
        paramTabla.setModel(modelo);
        
        String sql = "SELECT * FROM colaborador WHERE estado = 1;";
        String[] datos = new String[3];
        Statement st;
        
        try {
            st = objConexion.estableceConexion().createStatement();
            ResultSet rs = st.executeQuery(sql);
            
            while (rs.next()) {
                datos[0] = rs.getString(1);
                datos[1] = rs.getString(2);
                datos[2] = rs.getString(3);
                modelo.addRow(datos);
            }
            
            paramTabla.setModel(modelo);
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "No se pudo mostrar los registros: " + e.toString());
        }    
    }
    
    // Método para mostrar colaboradores eliminados
    public void MostrarColaboradoresEliminados(JTable paramTabla) {
        CConexion objConexion = new CConexion();
        DefaultTableModel modelo = new DefaultTableModel();
        TableRowSorter<TableModel> ordenarTabla = new TableRowSorter<>(modelo);
        paramTabla.setRowSorter(ordenarTabla);
        
        modelo.addColumn("Codigo");
        modelo.addColumn("Nombre");
        modelo.addColumn("Contraseña");
        paramTabla.setModel(modelo);
        
        String sql = "SELECT * FROM colaborador WHERE estado = 0;";
        String[] datos = new String[3];
        Statement st;
        
        try {
            st = objConexion.estableceConexion().createStatement();
            ResultSet rs = st.executeQuery(sql);
            
            while (rs.next()) {
                datos[0] = rs.getString(1);
                datos[1] = rs.getString(2);
                datos[2] = rs.getString(3);
                modelo.addRow(datos);
            }
            
            paramTabla.setModel(modelo);
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "No se pudo mostrar los registros eliminados: " + e.toString());
        }    
    }
    
    // Método para seleccionar un colaborador desde la tabla
    public void SeleccionarColaborador(JTable paramTabla, JTextField paramCodColaborador, JTextField paramNombre, JTextField paramContraseña) {
        try {
            int fila = paramTabla.getSelectedRow();
            if (fila >= 0) {
                paramCodColaborador.setText(paramTabla.getValueAt(fila, 0).toString());
                paramNombre.setText(paramTabla.getValueAt(fila, 1).toString());
                paramContraseña.setText(paramTabla.getValueAt(fila, 2).toString());
            } else {
                JOptionPane.showMessageDialog(null, "No se ha seleccionado una fila.");
            }
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "Error al seleccionar: " + e.toString());
        }
    }
    
    // Método para modificar un colaborador
    public void ModificarColaborador(JTextField paramCodColaborador, JTextField paramNombre, JTextField paramContraseña) {
        setCod_colaborador(Integer.parseInt(paramCodColaborador.getText()));
        setNombre_colaborador(paramNombre.getText());
        setContraseña(paramContraseña.getText());
        
        CConexion objConexion = new CConexion();
        String consulta = "UPDATE colaborador SET nombre_colaborador = ?, contraseña = ? WHERE cod_colaborador = ?;";
        
        try {
            CallableStatement cs = objConexion.estableceConexion().prepareCall(consulta);
            cs.setString(1, getNombre_colaborador());
            cs.setString(2, getContraseña());
            cs.setInt(3, getCod_colaborador());
            cs.execute();
            
            JOptionPane.showMessageDialog(null, "Modificación exitosa.");
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, "No se pudo modificar: " + e.getMessage());
        }
    }
    
    // Método para eliminar un colaborador (lógica)
    public void EliminarColaborador(JTextField paramCodColaborador) {
        if (paramCodColaborador.getText().isEmpty()) {
            JOptionPane.showMessageDialog(null, "Por favor, ingrese el código del colaborador.");
            return;
        }
        
        try {
            setCod_colaborador(Integer.parseInt(paramCodColaborador.getText()));
        } catch (NumberFormatException e) {
            JOptionPane.showMessageDialog(null, "El código debe ser un número.");
            return;
        }
        
        CConexion objConexion = new CConexion();
        String consulta = "UPDATE colaborador SET estado = 0 WHERE cod_colaborador = ?;";
        
        try {
            CallableStatement cs = objConexion.estableceConexion().prepareCall(consulta);
            cs.setInt(1, getCod_colaborador());
            cs.execute();
            
            JOptionPane.showMessageDialog(null, "Colaborador eliminado lógicamente.");
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "No se pudo eliminar: " + e.toString());
        }
    }
    
    // Método para restaurar un colaborador
    public void RestaurarColaborador(JTextField paramCodColaborador) {
        if (paramCodColaborador.getText().isEmpty()) {
            JOptionPane.showMessageDialog(null, "Por favor, ingrese el código del colaborador.");
            return;
        }
        
        try {
            setCod_colaborador(Integer.parseInt(paramCodColaborador.getText()));
        } catch (NumberFormatException e) {
            JOptionPane.showMessageDialog(null, "El código debe ser un número.");
            return;
        }
        
        CConexion objConexion = new CConexion();
        String consulta = "UPDATE colaborador SET estado = 1 WHERE cod_colaborador = ?;";
        
        try {
            CallableStatement cs = objConexion.estableceConexion().prepareCall(consulta);
            cs.setInt(1, getCod_colaborador());
            cs.execute();
            
            JOptionPane.showMessageDialog(null, "Colaborador restaurado correctamente.");
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "No se pudo restaurar: " + e.toString());
        }
    }
}

