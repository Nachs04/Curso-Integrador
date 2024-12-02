package com.mycompany.colaboradores;

import java.sql.CallableStatement;
import java.sql.PreparedStatement;
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
    public void MostrarColaborador(JTable paramTabla) {
        CConexion objConexion = new CConexion();
        DefaultTableModel modelo = new DefaultTableModel();
        TableRowSorter<TableModel> ordenarTabla = new TableRowSorter<>(modelo);
        paramTabla.setRowSorter(ordenarTabla);

        modelo.addColumn("Codigo");
        modelo.addColumn("Nombre");
        modelo.addColumn("Contraseña");
        modelo.addColumn("Estado"); // Nueva columna
        paramTabla.setModel(modelo);

        String sql = "SELECT cod_colaborador, nombre_colaborador, contraseña, estado FROM colaborador WHERE estado IN (0, 1);";  // Selecciona tanto activos como eliminados
        String[] datos = new String[4];
        Statement st;

        try {
            st = objConexion.estableceConexion().createStatement();
            ResultSet rs = st.executeQuery(sql);

            while (rs.next()) {
                datos[0] = rs.getString(1);
                datos[1] = rs.getString(2);
                datos[2] = rs.getString(3);
                datos[3] = rs.getInt(4) == 1 ? "Activo" : "Inactivo"; // Estado en texto
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
            modelo.addColumn("Estado"); // Nueva columna
            paramTabla.setModel(modelo);

            String sql = "SELECT cod_colaborador, nombre_colaborador, contraseña, estado FROM colaborador WHERE estado = 0;";
            String[] datos = new String[4];
            Statement st;

            try {
                st = objConexion.estableceConexion().createStatement();
                ResultSet rs = st.executeQuery(sql);

                while (rs.next()) {
                    datos[0] = rs.getString(1);
                    datos[1] = rs.getString(2);
                    datos[2] = rs.getString(3);
                    datos[3] = rs.getInt(4) == 1 ? "Activo" : "Inactivo"; // Estado en texto
                    modelo.addRow(datos);
                }

                paramTabla.setModel(modelo);
            } catch (Exception e) {
                JOptionPane.showMessageDialog(null, "No se pudo mostrar los registros eliminados: " + e.toString());
            }    
        }
        public void MostrarColaboradoresActivos(JTable paramTabla) {
            CConexion objConexion = new CConexion();
            DefaultTableModel modelo = new DefaultTableModel();
            TableRowSorter<TableModel> ordenarTabla = new TableRowSorter<>(modelo);
            paramTabla.setRowSorter(ordenarTabla);

            modelo.addColumn("Codigo");
            modelo.addColumn("Nombre");
            modelo.addColumn("Contraseña");
            modelo.addColumn("Estado"); // Nueva columna
            paramTabla.setModel(modelo);

            String sql = "SELECT cod_colaborador, nombre_colaborador, contraseña, estado FROM colaborador WHERE estado = 1;";
            String[] datos = new String[4];
            Statement st;

            try {
                st = objConexion.estableceConexion().createStatement();
                ResultSet rs = st.executeQuery(sql);

                while (rs.next()) {
                    datos[0] = rs.getString(1);
                    datos[1] = rs.getString(2);
                    datos[2] = rs.getString(3);
                    datos[3] = rs.getInt(4) == 1 ? "Activo" : "Inactivo"; // Estado en texto
                    modelo.addRow(datos);
                }

                paramTabla.setModel(modelo);
            } catch (Exception e) {
                JOptionPane.showMessageDialog(null, "No se pudo mostrar los registros activos: " + e.toString());
            }
        }

    
    // Método para seleccionar un colaborador desde la tabla
    public void SeleccionarColaborador(JTable paramTabla, JTextField paramCodColaborador, JTextField paramNombre, JTextField paramContraseña) {
        int fila = paramTabla.getSelectedRow();
        if (fila == -1) {
            JOptionPane.showMessageDialog(null, "Debe seleccionar una fila de la tabla.");
            return;
        }

        try {
            paramCodColaborador.setText(paramTabla.getValueAt(fila, 0).toString());
            paramNombre.setText(paramTabla.getValueAt(fila, 1).toString());
            paramContraseña.setText(paramTabla.getValueAt(fila, 2).toString());
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "Error al seleccionar colaborador: " + e.toString());
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
            public boolean RestaurarColaborador(int codigoColaborador) {
            CConexion objConexion = new CConexion();
            String sql = "UPDATE colaborador SET estado = 1 WHERE cod_colaborador = ?;";

            try {
                // Preparar la consulta
                PreparedStatement ps = objConexion.estableceConexion().prepareStatement(sql);
                ps.setInt(1, codigoColaborador);

                // Ejecutar la actualización
                int resultado = ps.executeUpdate();
                return resultado > 0; // Retorna true si se actualizó correctamente

            } catch (Exception e) {
                JOptionPane.showMessageDialog(null, "Error al restaurar colaborador: " + e.toString());
                return false;
            }
        }

    public void MostrarColaboradoresPorEstado(JTable paramTabla, int estado) {
        CConexion objConexion = new CConexion();
        DefaultTableModel modelo = new DefaultTableModel();

        // Agregar las columnas
        modelo.addColumn("Codigo");
        modelo.addColumn("Nombre");
        modelo.addColumn("Contraseña");
        modelo.addColumn("Estado");

        // Establecer el modelo a la tabla
        paramTabla.setModel(modelo);

        // Consulta SQL
        String sql = "SELECT cod_colaborador, nombre_colaborador, contraseña, estado FROM colaborador WHERE estado = ?;";
        String[] datos = new String[4];

        try {
            // Preparar la consulta
            PreparedStatement ps = objConexion.estableceConexion().prepareStatement(sql);
            ps.setInt(1, estado);
            ResultSet rs = ps.executeQuery();

            // Llenar los datos en el modelo
            while (rs.next()) {
                datos[0] = rs.getString(1); // Código
                datos[1] = rs.getString(2); // Nombre
                datos[2] = rs.getString(3); // Contraseña
                datos[3] = estado == 1 ? "Activo" : "Inactivo"; // Estado
                modelo.addRow(datos);
            }

            // Aplicar el modelo actualizado a la tabla
            paramTabla.setModel(modelo);

        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "No se pudo mostrar los registros: " + e.toString());
        }
    }
    
}

