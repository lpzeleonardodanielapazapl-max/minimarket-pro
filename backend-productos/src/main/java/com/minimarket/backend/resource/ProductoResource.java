package com.minimarket.backend.resource;

import java.util.List;

import com.minimarket.backend.entity.Producto;

import jakarta.transaction.Transactional;
import jakarta.ws.rs.Consumes;
import jakarta.ws.rs.DELETE;
import jakarta.ws.rs.GET;
import jakarta.ws.rs.POST;
import jakarta.ws.rs.PUT;
import jakarta.ws.rs.Path;
import jakarta.ws.rs.PathParam;
import jakarta.ws.rs.Produces;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;

@Path("/api/productos")
@Produces(MediaType.APPLICATION_JSON)
@Consumes(MediaType.APPLICATION_JSON)
public class ProductoResource {

    // 1. LISTAR SOLO ACTIVOS
    @GET
    public List<Producto> listar() {
        return Producto.list("eliminado", false);
    }

    // 2. OBTENER UNO POR ID
    @GET
    @Path("/{id}")
    public Response obtener(@PathParam("id") Long id) {
        Producto p = Producto.findById(id);
        if (p == null || p.eliminado) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
        return Response.ok(p).build();
    }

    // 3. CREAR
    @POST
    @Transactional
    public Response crear(Producto producto) {
        producto.id = null;
        producto.eliminado = false;
        producto.persist();
        return Response.status(Response.Status.CREATED).entity(producto).build();
    }

    // 4. EDITAR
    @PUT
    @Path("/{id}")
    @Transactional
    public Response editar(@PathParam("id") Long id, Producto datos) {
        Producto p = Producto.findById(id);
        if (p == null || p.eliminado) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
        p.nombre = datos.nombre;
        p.proveedor = datos.proveedor;
        p.fechaVencimiento = datos.fechaVencimiento;
        p.precio = datos.precio;
        p.stock = datos.stock;
        return Response.ok(p).build();
    }

    // 5. ELIMINACIÓN LÓGICA
    @DELETE
    @Path("/{id}")
    @Transactional
    public Response eliminarLogicamente(@PathParam("id") Long id) {
        Producto p = Producto.findById(id);
        if (p == null || p.eliminado) {
            return Response.status(Response.Status.NOT_FOUND).build();
        }
        p.eliminado = true;
        return Response.noContent().build();
    }
}