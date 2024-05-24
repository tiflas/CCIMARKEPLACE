<?php

	class consulta{

        function empreAll(){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * from EMPRESAS where IDTIPOEMPRESA = 1 AND ELIMINADO = 0 and NOMBFANTASIA <> '' order by NOMBFANTASIA";
            $query = $conexion->prepare($sql);
            $query->execute();
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function empreAllprove(){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * from EMPRESAS where IDTIPOEMPRESA = 2 AND ELIMINADO = 0 and NOMBFANTASIA <> '' order by NOMBFANTASIA asc";
            $query = $conexion->prepare($sql);
            $query->execute();
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function empreAllprovebuscar($busempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = " SELECT * from EMPRESAS where NOMBEMPRESA like '%$busempresa%' and IDTIPOEMPRESA = 2 AND ELIMINADO = 0 and NOMBFANTASIA <> '' order by NOMBFANTASIA asc";
            $query = $conexion->prepare($sql);
            $query->execute();
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consultaprove($empresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT  empresas.idempresa idempresa,empresas.nombfantasia nombre,razo.rut rut, case when EMPRESAS.ELIMINADO = 0 then 'ACTIVO' when EMPRESAS.ELIMINADO = 1 then 'ELIMINADO' END as estado,EMPRESAS.IDPAIS pais from empresas inner join razonsocial razo on razo.idempresa = empresas.idempresa where EMPRESAS.IDEMPRESA = ?";
            $query = $conexion->prepare($sql);
            $query->execute(array($empresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function editarprove($empresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT  empresas.idempresa idempresa,empresas.nombfantasia nombre,razo.rut rut, case when EMPRESAS.ELIMINADO = 0 then 'ACTIVO' when EMPRESAS.ELIMINADO = 1 then 'ELIMINADO' END as estado,EMPRESAS.IDPAIS pais from empresas inner join razonsocial razo on razo.idempresa = empresas.idempresa where EMPRESAS.IDEMPRESA = ?";
            $query = $conexion->prepare($sql);
            $query->execute(array($empresa));
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function actualizarpro($idempresa,$pais){
            $conexion=ccimarketplace::Connect();
            $conexion->SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta="UPDATE EMPRESAS SET IDPAIS=?  WHERE IDEMPRESA=?";
            $query=$conexion->prepare($consulta);
            $query->execute(array($pais,$idempresa));

            ccimarketplace::Disconnect();
        }

        function estado(){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * from estadosdoc order by DESCRIPCION";
            $query = $conexion->prepare($sql);
            $query->execute();
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function errorlog($fecha){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT InMaLo_IdEmpresa 'idempresa',InMaLo_FechaProcesado 'Fecha',InMaLo_ResultadoProceso 'resultado',InMaLo_DatoPrincipal 'oc',InMaLo_TipoMaestro 'timaestro'FROM IntegracionMaestrosLog inner join EMPRESAS em on em.IDEMPRESA = IntegracionMaestrosLog.InMaLo_IdEmpresa WHERE InMaLo_ResultadoProceso <> 'Proceso termino correctamente' and InMaLo_TipoMaestro like '%OrdenCompra%' and  CONVERT(varchar(8), InMaLo_FechaProcesado,112) = ?";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function numcotiza($fecha,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count( NUMCZ) numcz from CZ where  CONVERT(varchar(8), FECHACREACION,112)  BETWEEN ? AND ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha,$fecha2));
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

         function numordec($fecha,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count( NUMOC) numoc from OC where  CONVERT(varchar(8), FECHACREACION,112)  BETWEEN ? AND ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha,$fecha2));
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        } 

        function consoc($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc 
            idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,rutorgv
            nitproveedor,emp.nombempresa EmpresaProveedora,orv.idorgv idSucursalVenta,orv.nombre 
            SucursalVenta,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda idmoneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST
            (oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion 
            estadodoc,forpago.DESCRIPCORTA descripformapago,forpago.DESCRIPLARGA formadepago from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on 
            emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join 
            orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc 
            left join oclineas ocl on ocl.idoc = oc.idoc LEFT OUTER JOIN FORMASPAGO forpago ON OC.IDFORMAPAGO = forpago.IDFORMAPAGO where convert(varchar(8),oc.fechaenvio,112) 
            BETWEEN ? AND ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,
            orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,
            orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,forpago.DESCRIPCORTA,forpago.DESCRIPLARGA order by oc.fechaenvio";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consocempre($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,rutorgv nitproveedor,emp.nombempresa EmpresaProveedora,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda idmoneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc,forpago.DESCRIPCORTA descripformapago,forpago.DESCRIPLARGA formadepago from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc LEFT OUTER JOIN FORMASPAGO forpago ON OC.IDFORMAPAGO = forpago.IDFORMAPAGO where convert(varchar(8),oc.fechaenvio,112) BETWEEN ? AND ? and emp2.IDEMPRESA = ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,forpago.DESCRIPCORTA,forpago.DESCRIPLARGA order by oc.fechaenvio";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function nointegrados($fecha1,$fecha2,$idempresa,$estado,$visibilidad){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,razo.RUT Nit,CASE WHEN orv.ESINTEGRADO = 0 THEN 'INTEGRADO' WHEN  orv.ESINTEGRADO = 1 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,CASE WHEN emp.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'CorreoContacto',conta.TELEFONO 'Telefono',Conta.MOVIL 'Celular',dire.DIRECCION1 direccion,COMUNA.NOMCOMUNA ciudad,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = orv.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = OC.IDORGV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA inner join RAZONSOCIAL razo on razo.IDEMPRESA = emp.IDEMPRESA where convert(varchar(8),oc.fechaenvio,112) between ? and ? and emp2.IDEMPRESA = ? and ed.IDESTADODOC  = ?  and orv.ESINTEGRADO = ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,conta.NOMCONTACTO,conta.EMAIL,conta.TELEFONO,conta.LOCALCONTACTO,conta.MOVIL,dire.DIRECCION1,COMUNA.NOMCOMUNA,emp.VISIBILIDAD,emp.ELIMINADO,razo.RUT, orv.ESINTEGRADO order by oc.fechaenvio";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa,$estado,$visibilidad));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function nointegrados1($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,razo.RUT Nit,CASE WHEN orv.ESINTEGRADO = 0 THEN 'INTEGRADO' WHEN  orv.ESINTEGRADO = 1 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,CASE WHEN emp.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'CorreoContacto',conta.TELEFONO 'Telefono',Conta.MOVIL 'Celular',dire.DIRECCION1 direccion,COMUNA.NOMCOMUNA ciudad,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = orv.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = OC.IDORGV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA inner join RAZONSOCIAL razo on razo.IDEMPRESA = emp.IDEMPRESA where convert(varchar(8),oc.fechaenvio,112) between ? and ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,conta.NOMCONTACTO,conta.EMAIL,conta.TELEFONO,conta.LOCALCONTACTO,conta.MOVIL,dire.DIRECCION1,COMUNA.NOMCOMUNA,emp.VISIBILIDAD,emp.ELIMINADO,razo.RUT, orv.ESINTEGRADO order by oc.fechaenvio";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function nointegrados2($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,razo.RUT Nit,CASE WHEN orv.ESINTEGRADO = 0 THEN 'INTEGRADO' WHEN  orv.ESINTEGRADO = 1 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,CASE WHEN emp.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'CorreoContacto',conta.TELEFONO 'Telefono',Conta.MOVIL 'Celular',dire.DIRECCION1 direccion,COMUNA.NOMCOMUNA ciudad,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = orv.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = OC.IDORGV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA inner join RAZONSOCIAL razo on razo.IDEMPRESA = emp.IDEMPRESA where convert(varchar(8),oc.fechaenvio,112) between ? and ? and emp2.IDEMPRESA = ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,conta.NOMCONTACTO,conta.EMAIL,conta.TELEFONO,conta.LOCALCONTACTO,conta.MOVIL,dire.DIRECCION1,COMUNA.NOMCOMUNA,emp.VISIBILIDAD,emp.ELIMINADO,razo.RUT, orv.ESINTEGRADO order by oc.fechaenvio";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function nointegrados3($fecha1,$fecha2,$estado){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,razo.RUT Nit,CASE WHEN orv.ESINTEGRADO = 0 THEN 'INTEGRADO' WHEN  orv.ESINTEGRADO = 1 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,CASE WHEN emp.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'CorreoContacto',conta.TELEFONO 'Telefono',Conta.MOVIL 'Celular',dire.DIRECCION1 direccion,COMUNA.NOMCOMUNA ciudad,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = orv.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = OC.IDORGV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA inner join RAZONSOCIAL razo on razo.IDEMPRESA = emp.IDEMPRESA where convert(varchar(8),oc.fechaenvio,112) between ? and ? and ed.IDESTADODOC = ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,conta.NOMCONTACTO,conta.EMAIL,conta.TELEFONO,conta.LOCALCONTACTO,conta.MOVIL,dire.DIRECCION1,COMUNA.NOMCOMUNA,emp.VISIBILIDAD,emp.ELIMINADO,razo.RUT, orv.ESINTEGRADO order by oc.fechaenvio";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$estado));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function nointegrados4($fecha1,$fecha2,$visibilidad){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,razo.RUT Nit,CASE WHEN orv.ESINTEGRADO = 0 THEN 'INTEGRADO' WHEN  orv.ESINTEGRADO = 1 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,CASE WHEN emp.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'CorreoContacto',conta.TELEFONO 'Telefono',Conta.MOVIL 'Celular',dire.DIRECCION1 direccion,COMUNA.NOMCOMUNA ciudad,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = orv.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = OC.IDORGV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA inner join RAZONSOCIAL razo on razo.IDEMPRESA = emp.IDEMPRESA where convert(varchar(8),oc.fechaenvio,112) between ? and ? and orv.ESINTEGRADO = ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,conta.NOMCONTACTO,conta.EMAIL,conta.TELEFONO,conta.LOCALCONTACTO,conta.MOVIL,dire.DIRECCION1,COMUNA.NOMCOMUNA,emp.VISIBILIDAD,emp.ELIMINADO,razo.RUT, orv.ESINTEGRADO order by oc.fechaenvio";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$visibilidad));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function nointegrados5($fecha1,$fecha2,$idempresa,$estado){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,razo.RUT Nit,CASE WHEN orv.ESINTEGRADO = 0 THEN 'INTEGRADO' WHEN  orv.ESINTEGRADO = 1 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,CASE WHEN emp.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'CorreoContacto',conta.TELEFONO 'Telefono',Conta.MOVIL 'Celular',dire.DIRECCION1 direccion,COMUNA.NOMCOMUNA ciudad,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = orv.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = OC.IDORGV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA inner join RAZONSOCIAL razo on razo.IDEMPRESA = emp.IDEMPRESA where convert(varchar(8),oc.fechaenvio,112) between ? and ? and emp2.IDEMPRESA = ? and ed.IDESTADODOC = ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,conta.NOMCONTACTO,conta.EMAIL,conta.TELEFONO,conta.LOCALCONTACTO,conta.MOVIL,dire.DIRECCION1,COMUNA.NOMCOMUNA,emp.VISIBILIDAD,emp.ELIMINADO,razo.RUT, orv.ESINTEGRADO order by oc.fechaenvio";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa,$estado));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function nointegrados6($fecha1,$fecha2,$idempresa,$visibilidad){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,razo.RUT Nit,CASE WHEN orv.ESINTEGRADO = 0 THEN 'INTEGRADO' WHEN  orv.ESINTEGRADO = 1 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,CASE WHEN emp.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'CorreoContacto',conta.TELEFONO 'Telefono',Conta.MOVIL 'Celular',dire.DIRECCION1 direccion,COMUNA.NOMCOMUNA ciudad,oc.fechaenvio fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = orv.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = OC.IDORGV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA inner join RAZONSOCIAL razo on razo.IDEMPRESA = emp.IDEMPRESA where convert(varchar(8),oc.fechaenvio,112) between ? and ? and emp2.IDEMPRESA = ? and orv.ESINTEGRADO = ? group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,conta.NOMCONTACTO,conta.EMAIL,conta.TELEFONO,conta.LOCALCONTACTO,conta.MOVIL,dire.DIRECCION1,COMUNA.NOMCOMUNA,emp.VISIBILIDAD,emp.ELIMINADO,razo.RUT, orv.ESINTEGRADO order by oc.fechaenvio";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa,$visibilidad));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function conscz($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT cz.idempresa empresaCompradora, rtrim(replace(replace(replace(replace(ec.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreEmpresaCompradora, cz.idorgc idcentrocostoCompradora, rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora, cz.numcz, rtrim(replace(replace(replace(replace(cz.nomcz , char(9), ''), char(44), ''),char(13),''),char(10),'')) nombreCotizacion,cz.FECHACREACION FechaCreacionCotizacion, ed.DESCRIPCION estadoCotizacion, czp.IDEMPRESAV IDEmpresaInvitada,rtrim(replace(replace(replace(replace(eczp.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaInvitada,ofe.IDOF idOferta, rtrim(replace(replace(replace(replace(ofe.NOMOF, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreOferta,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,rtrim(replace(replace(replace(replace(oo.nombre, char(44), ''), char(9), ''),char(13),''),char(10),'')) sucursalOferto,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'Correo Contacto',conta.TELEFONO 'Telefono contacto',Conta.MOVIL 'Celular',dire.DIRECCION1,COMUNA.NOMCOMUNA 'ciudad',rtrim(replace(replace(replace(replace((case when ofe.IDESTADOADJ = 1 then 'Adjudicada' else 'NO Adjudicada' end), char(9), ''), char(44), ''),char(13),''),char(10),''))   EstadoAdjudicacionOferta, rtrim(replace(replace(replace(replace((select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC), char(44), ''), char(9), ''),char(13),''),char(10),'')) estadoOferta, case when (select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC) = 'Oferta Guardada' or (select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ) <= 0 then 'NO' else 'SI' end Ofertó, replace((select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ),'.',',') valorOfertado from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA = cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = oo.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = ofe.IDEMPRESAV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA where convert(varchar(8), cz.FECHACREACION, 112) BETWEEN ? AND ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consczsincontac($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT cz.idempresa empresaCompradora, rtrim(replace(replace(replace(replace(ec.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreEmpresaCompradora, cz.idorgc idcentrocostoCompradora,rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora, cz.numcz, rtrim(replace(replace(replace(replace(cz.nomcz, char(9), ''), char(44), ''),char(13),''),char(10),'')) nombreCotizacion,cz.FECHACREACION FechaCreacionCotizacion, ed.DESCRIPCION estadoCotizacion, czp.IDEMPRESAV IDEmpresaInvitada,rtrim(replace(replace(replace(replace(eczp.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaInvitada,ofe.IDOF idOferta, rtrim(replace(replace(replace(replace(ofe.NOMOF, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreOferta,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,rtrim(replace(replace(replace(replace(oo.nombre, char(44), ''), char(9), ''),char(13),''),char(10),'')) sucursalOferto,rtrim(replace(replace(replace(replace((case when ofe.IDESTADOADJ = 1 then 'Adjudicada' else 'NO Adjudicada' end), char(9), ''), char(44), ''),char(13),''),char(10),''))   EstadoAdjudicacionOferta,rtrim(replace(replace(replace(replace((select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC), char(44), ''), char(9), ''),char(13),''),char(10),'')) estadoOferta, case when (select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC) = 'Oferta Guardada' or (select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ) <= 0 then 'NO' else 'SI' end Ofertó,replace((select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ),'.',',') valorOfertado from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA = cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV where convert(varchar(8), cz.FECHACREACION, 112) between ? and ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consczsincontacempre($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT cz.idempresa empresaCompradora, rtrim(replace(replace(replace(replace(ec.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreEmpresaCompradora, cz.idorgc idcentrocostoCompradora,rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora, cz.numcz, rtrim(replace(replace(replace(replace(cz.nomcz, char(9), ''), char(44), ''),char(13),''),char(10),'')) nombreCotizacion,cz.FECHACREACION FechaCreacionCotizacion, ed.DESCRIPCION estadoCotizacion, czp.IDEMPRESAV IDEmpresaInvitada,rtrim(replace(replace(replace(replace(eczp.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaInvitada,ofe.IDOF idOferta, rtrim(replace(replace(replace(replace(ofe.NOMOF, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreOferta,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,rtrim(replace(replace(replace(replace(oo.nombre, char(44), ''), char(9), ''),char(13),''),char(10),'')) sucursalOferto,rtrim(replace(replace(replace(replace((case when ofe.IDESTADOADJ = 1 then 'Adjudicada' else 'NO Adjudicada' end), char(9), ''), char(44), ''),char(13),''),char(10),''))   EstadoAdjudicacionOferta,rtrim(replace(replace(replace(replace((select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC), char(44), ''), char(9), ''),char(13),''),char(10),'')) estadoOferta, case when (select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC) = 'Oferta Guardada' or (select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ) <= 0 then 'NO' else 'SI' end Ofertó,replace((select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ),'.',',') valorOfertado from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA = cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV where convert(varchar(8), cz.FECHACREACION, 112) between ? and ? and CZ.IDEMPRESA = ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consczempre($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT cz.idempresa empresaCompradora, rtrim(replace(replace(replace(replace(ec.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreEmpresaCompradora, cz.idorgc idcentrocostoCompradora, rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora, cz.numcz, rtrim(replace(replace(replace(replace(cz.nomcz , char(9), ''), char(44), ''),char(13),''),char(10),'')) nombreCotizacion,cz.FECHACREACION FechaCreacionCotizacion, ed.DESCRIPCION estadoCotizacion, czp.IDEMPRESAV IDEmpresaInvitada,rtrim(replace(replace(replace(replace(eczp.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaInvitada,ofe.IDOF idOferta, rtrim(replace(replace(replace(replace(ofe.NOMOF, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreOferta,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,rtrim(replace(replace(replace(replace(oo.nombre, char(44), ''), char(9), ''),char(13),''),char(10),'')) sucursalOferto,conta.NOMCONTACTO 'Contacto',conta.EMAIL 'Correo Contacto',conta.TELEFONO 'Telefono contacto',Conta.MOVIL 'Celular',dire.DIRECCION1,COMUNA.NOMCOMUNA 'ciudad',rtrim(replace(replace(replace(replace((case when ofe.IDESTADOADJ = 1 then 'Adjudicada' else 'NO Adjudicada' end), char(9), ''), char(44), ''),char(13),''),char(10),''))   EstadoAdjudicacionOferta, rtrim(replace(replace(replace(replace((select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC), char(44), ''), char(9), ''),char(13),''),char(10),'')) estadoOferta, case when (select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC) = 'Oferta Guardada' or (select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ) <= 0 then 'NO' else 'SI' end Ofertó, replace((select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ),'.',',') valorOfertado from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA = cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = oo.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = ofe.IDEMPRESAV inner join DIRECCION dire on dire.IDDIRECCION = orgdi.IDDIRECCION inner join COMUNA on COMUNA.IDCOMUNA = dire.IDCOMUNA where convert(varchar(8), cz.FECHACREACION, 112) BETWEEN ? AND ? and CZ.IDEMPRESA = ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function ofertaidempresa($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT cz.idempresa empresaCompradora, rtrim(replace(replace(replace(replace(ec.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreEmpresaCompradora, cz.idorgc idcentrocostoCompradora,rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora, cz.numcz, rtrim(replace(replace(replace(replace(cz.nomcz, char(9), ''), char(44), ''),char(13),''),char(10),'')) nombreCotizacion,cz.FECHACREACION FechaCreacionCotizacion, ed.DESCRIPCION estadoCotizacion, czp.IDEMPRESAV IDEmpresaInvitada,rtrim(replace(replace(replace(replace(eczp.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaInvitada,ofe.IDOF idOferta, rtrim(replace(replace(replace(replace(ofe.NOMOF, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreOferta,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,rtrim(replace(replace(replace(replace(oo.nombre, char(44), ''), char(9), ''),char(13),''),char(10),'')) sucursalOferto, rtrim(replace(replace(replace(replace(czlinea.NOMBARTICULO, char(44), ''), char(9), ''),char(13),''),char(10),'')) Detalle,czlinea.CANTIDAD cantidad,rtrim(replace(replace(replace(replace((case when ofe.IDESTADOADJ = 1 then 'Adjudicada' else 'NO Adjudicada' end), char(9), ''), char(44), ''),char(13),''),char(10),''))   EstadoAdjudicacionOferta,rtrim(replace(replace(replace(replace((select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC), char(44), ''), char(9), ''),char(13),''),char(10),'')) estadoOferta,case when (select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC) = 'Oferta Guardada' or (select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ) <= 0 then 'NO' else 'SI' end Ofertó, replace((select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ),'.',',') valorOfertado from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA = cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV inner join CZLINEAS czlinea on czlinea.IDCZ = CZ.IDCZ where convert(varchar(8), cz.FECHACREACION, 112) between ? and ? and cz.IDEMPRESA = ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consunumcz($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT distinct cz.NUMCZ numcz,estadoc.DESCRIPCION descricz,oc.NUMOC numoc,estadocc.DESCRIPCION descrioc,em.NOMBFANTASIA emprecompra,emv.NOMBFANTASIA proveedor,USUARIOS.NOMBRE usuario,REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') total,cz.FECHACREACION fechacz from cz inner join CZLINEAS on CZLINEAS.IDCZ = cz.IDCZ inner join pm on pm.IDPM = CZLINEAS.IDPM inner join OCLINEAS ocli on ocli.IDPM = pm.IDPM left join oc on oc.IDOC = ocli.IDOC inner join ESTADOSDOC estadoc on estadoc.IDESTADODOC = CZLINEAS.IDESTADODOC inner join ESTADOSDOC estadocc on estadocc.IDESTADODOC = oc.IDESTADODOC inner join usuarios on USUARIOS.IDUSUARIO = oc.IDUSUARIO inner join empresas em on em.IDEMPRESA = oc.IDEMPRESA inner join EMPRESAS emv on emv.IDEMPRESA = oc.IDEMPRESAV  where convert(varchar(8), cz.FECHACREACION,112) between ? and ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function ofertatodas($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT cz.idempresa empresaCompradora, rtrim(replace(replace(replace(replace(ec.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreEmpresaCompradora, cz.idorgc idcentrocostoCompradora,rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora, cz.numcz, rtrim(replace(replace(replace(replace(cz.nomcz, char(9), ''), char(44), ''),char(13),''),char(10),'')) nombreCotizacion,cz.FECHACREACION FechaCreacionCotizacion, ed.DESCRIPCION estadoCotizacion, czp.IDEMPRESAV IDEmpresaInvitada,rtrim(replace(replace(replace(replace(eczp.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaInvitada,ofe.IDOF idOferta, rtrim(replace(replace(replace(replace(ofe.NOMOF, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreOferta,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,rtrim(replace(replace(replace(replace(oo.nombre, char(44), ''), char(9), ''),char(13),''),char(10),'')) sucursalOferto, rtrim(replace(replace(replace(replace(czlinea.NOMBARTICULO, char(44), ''), char(9), ''),char(13),''),char(10),'')) Detalle,czlinea.CANTIDAD cantidad,rtrim(replace(replace(replace(replace((case when ofe.IDESTADOADJ = 1 then 'Adjudicada' else 'NO Adjudicada' end), char(9), ''), char(44), ''),char(13),''),char(10),''))   EstadoAdjudicacionOferta,rtrim(replace(replace(replace(replace((select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC), char(44), ''), char(9), ''),char(13),''),char(10),'')) estadoOferta,case when (select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC) = 'Oferta Guardada' or (select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ) <= 0 then 'NO' else 'SI' end Ofertó, replace((select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ),'.',',') valorOfertado from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA = cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV inner join CZLINEAS czlinea on czlinea.IDCZ = CZ.IDCZ where convert(varchar(8), cz.FECHACREACION, 112) between ? and ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function conspt($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT ei.coditem CodigoItem, replace(replace(replace(ei.descripcion, char(9), ''), char(13),''), char(10), '') DescripcionItem, ei.iduom IdUnidadMedida,u.DESCRIPLARGA unidadMedida,ei.ACTIVO, ei.porcimpuesto, ei.fechacreacion, ei.fechaactualizacion,replace(replace(replace(mc.descripcion, char(9),''), char(13),''), char(10), '') DescripcionClasificacion,replace(replace(replace(mc.ruta, char(9), ''), char(13),''), char(10), '') RutaItem from empitem ei inner join MSTRITEM mi on ei.IDMSTRITEM = mi.IDMSTRITEM inner join uom u on ei.iduom = u.iduom inner join MSTRCLASIFICACION mc on mc.IDNODO = mi.IDNODO where convert(varchar(8), ei.FECHAACTUALIZACION, 112) between ? and ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consptempresa($empresa,$fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT ei.coditem CodigoItem, replace(replace(replace(ei.descripcion, char(9), ''), char(13),''), char(10), '') DescripcionItem, ei.iduom IdUnidadMedida,u.DESCRIPLARGA unidadMedida,ei.ACTIVO, ei.porcimpuesto, ei.fechacreacion, ei.fechaactualizacion,replace(replace(replace(mc.descripcion, char(9),''), char(13),''), char(10), '') DescripcionClasificacion,replace(replace(replace(mc.ruta, char(9), ''), char(13),''), char(10), '') RutaItem from empitem ei inner join MSTRITEM mi on ei.IDMSTRITEM = mi.IDMSTRITEM inner join uom u on ei.iduom = u.iduom inner join MSTRCLASIFICACION mc on mc.IDNODO = mi.IDNODO where idempresa = ? and convert(varchar(8), ei.FECHAACTUALIZACION, 112) between ? and ? ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($empresa,$fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consarticuloavan($fecha,$articulo1,$articulo2,$articulo3){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT e.NOMBEMPRESA as EMPRESACOMPRADORA,em.NOMBEMPRESA as EMPRESAVENDEDORA,CASE WHEN em.VISIBILIDAD = 1 THEN 'COMPRADOR' ELSE 'PROVEEDOR' END as TIPOEMPRESA,ol.NOMBARTICULO 'ARTICULO',ol.DESCRIPPARTIDA 'DESCRIPCION',ol.COMENTARIOS,ceiling(sum(ol.CANTIDAD))as CANTIDAD, ceiling(sum(ol.cantidad * ol.preciounitario)) VALOR from oc inner join oclineas ol on oc.idempresa = ol.idempresa inner join empresas e on e.idempresa = oc.idempresa and oc.idorgc =  ol.idorgc and oc.idoc = ol.idoc inner join empresas em on em.IDEMPRESA= oc.IDEMPRESAV where convert(varchar(8), oc.fechaenvio, 112) >= ? and ol.NOMBARTICULO like ? or ol.DESCRIPPARTIDA like ? or ol.COMENTARIOS like '%?%' group by e.NOMBEMPRESA,em.VISIBILIDAD,em.NOMBEMPRESA,ol.CANTIDAD,ol.NOMBARTICULO,ol.DESCRIPPARTIDA,ol.COMENTARIOS";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha,$articulo1,$articulo2,$articulo3));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function consinsumoprovee($fecha1,$fecha2,$articulo,$articulo1,$articulo2,$articulo3){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT distinct em.NOMBFANTASIA as proveedor , razo.RUT rut,em.IDEMPRESA idempresa from oc inner join oclineas ol on oc.idempresa = ol.idempresa inner join empresas e on e.idempresa = oc.idempresa and oc.idorgc =  ol.idorgc and oc.idoc = ol.idoc inner join empresas em on em.IDEMPRESA= oc.IDEMPRESAV inner join RAZONSOCIAL razo on razo.IDEMPRESA = em.IDEMPRESA where ( (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.NOMBARTICULO like $articulo) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.COMENTARIOS like $articulo1) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.DESCRIPPARTIDA like $articulo2) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.GLOSA like $articulo3)) group by e.NOMBEMPRESA,em.VISIBILIDAD,em.NOMBFANTASIA,ol.CANTIDAD,ol.NOMBARTICULO,ol.DESCRIPPARTIDA,ol.COMENTARIOS,ol.GLOSA , OC.FECHAENVIO,em.IDEMPRESA,razo.RUT order by em.NOMBFANTASIA";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$articulo,$articulo1,$articulo2,$articulo3));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;  
        }

        function consarticulo($fecha1,$fecha2,$articulo,$articulo1,$articulo2,$articulo3){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT e.NOMBEMPRESA as EMPRESACOMPRADORA,em.NOMBEMPRESA as EMPRESAVENDEDORA,ol.NOMBARTICULO 'ARTICULO',ol.DESCRIPPARTIDA 'DESCRIPCION',ol.COMENTARIOS 'COMENTARIOS',ol.GLOSA 'OBSERVACION',ceiling(sum(ol.CANTIDAD))as CANTIDAD, ceiling(sum(ol.cantidad * ol.preciounitario)) VALOR, OC.FECHAENVIO from oc inner join oclineas ol on oc.idempresa = ol.idempresa inner join empresas e on e.idempresa = oc.idempresa and oc.idorgc =  ol.idorgc and oc.idoc = ol.idoc inner join empresas em on em.IDEMPRESA = oc.IDEMPRESAV where ( (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.NOMBARTICULO like $articulo) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.COMENTARIOS like $articulo1) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.DESCRIPPARTIDA like $articulo2) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.GLOSA like $articulo3)) group by e.NOMBEMPRESA,em.VISIBILIDAD,em.NOMBEMPRESA,ol.CANTIDAD,ol.NOMBARTICULO,ol.DESCRIPPARTIDA,ol.COMENTARIOS,ol.GLOSA , OC.FECHAENVIO order by  e.NOMBEMPRESA";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$articulo,$articulo1,$articulo2,$articulo3));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;   
        }

        function consarticulo2($fecha1,$fecha2,$articulo){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT e.NOMBEMPRESA as EMPRESACOMPRADORA,em.NOMBEMPRESA as EMPRESAVENDEDORA,em.IDEMPRESA IDEMPRESAVENDEDORA,CASE WHEN orgv.ESINTEGRADO = 1 THEN 'INTEGRADO' WHEN  orgv.ESINTEGRADO = 0 THEN 'NO INTEGRADO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,orgv.TELEFONO 'TELEFONO',orgv.EMAIL 'EMAIL',ol.NOMBARTICULO 'ARTICULO',ceiling(sum(ol.CANTIDAD))as CANTIDAD, ceiling(sum(ol.cantidad * ol.preciounitario)) VALOR from oc inner join oclineas ol on oc.idempresa = ol.idempresa inner join empresas e on e.idempresa = oc.idempresa and oc.idorgc =  ol.idorgc and oc.idoc = ol.idoc inner join empresas em on em.IDEMPRESA= oc.IDEMPRESAV inner join ORGV orgv on orgv.idorgv = oc.idorgv where convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.NOMBARTICULO like $articulo group by e.NOMBEMPRESA,em.VISIBILIDAD,em.NOMBEMPRESA,ol.CANTIDAD,ol.NOMBARTICULO,orgv.TELEFONO,orgv.EMAIL,orgv.ESINTEGRADO,em.IDEMPRESA";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$articulo));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;   
        }

        function consarticuloproveedor($fecha1,$fecha2,$articulo,$articulo1,$articulo2,$articulo3,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT e.NOMBEMPRESA as EMPRESACOMPRADORA,em.NOMBEMPRESA as EMPRESAVENDEDORA,ol.NOMBARTICULO 'ARTICULO',ol.DESCRIPPARTIDA 'DESCRIPCION',ol.COMENTARIOS 'COMENTARIOS',ol.GLOSA 'OBSERVACION',ceiling(sum(ol.CANTIDAD))as CANTIDAD, ceiling(sum(ol.cantidad * ol.preciounitario)) VALOR, OC.FECHAENVIO from oc inner join oclineas ol on oc.idempresa = ol.idempresa inner join empresas e on e.idempresa = oc.idempresa and oc.idorgc =  ol.idorgc and oc.idoc = ol.idoc inner join empresas em on em.IDEMPRESA = oc.IDEMPRESAV where ( (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.NOMBARTICULO like $articulo) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.COMENTARIOS like $articulo1) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.DESCRIPPARTIDA like $articulo2) or (convert(varchar(8), oc.fechaenvio, 112) between $fecha1 and $fecha2 and ol.GLOSA like $articulo3)) and em.IDEMPRESA in ($idempresa) group by e.NOMBEMPRESA,em.VISIBILIDAD,em.NOMBEMPRESA,ol.CANTIDAD,ol.NOMBARTICULO,ol.DESCRIPPARTIDA,ol.COMENTARIOS,ol.GLOSA , OC.FECHAENVIO order by  e.NOMBEMPRESA";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$articulo,$articulo1,$articulo2,$articulo3,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function sumtotaloc($fechalf1,$fechali){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(oc.total - oc.descuentos) AS DECIMAL (18,2)))), '.', ',') total from oc where convert(varchar(8),oc.fechaenvio,112) between ? and ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fechalf1,$fechali));
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function numoc(){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(oc.idoc) totaloc from oc where convert(varchar(8),oc.fechaenvio,112) between case when MONTH(DATEADD(M,-1, GETDATE() )) < 12 then CONVERT (VARCHAR, YEAR(GETDATE()))+ replicate('0',2-len(CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))))+CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))+'01' else CONVERT (VARCHAR, YEAR(DATEADD(m,-1, GETDATE())))+ replicate('0',2-len(CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))))+CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))+'01' end and CONVERT (VARCHAR, YEAR(GETDATE()))+ replicate('0',2-len(convert(varchar, MONTH(GETDATE())))) + convert(varchar, MONTH(GETDATE()))+'01'";
            $query = $conexion->prepare($sql);
            $query->execute();
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function numcz(){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(IDCZ) totalczge from cz where convert(varchar(8),FECHACREACION,112) between case when MONTH(DATEADD(M,-1, GETDATE() )) < 12 then CONVERT (VARCHAR, YEAR(GETDATE()))+ replicate('0',2-len(CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))))+CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))+'01' else CONVERT (VARCHAR, YEAR(DATEADD(m,-1, GETDATE())))+ replicate('0',2-len(CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))))+CONVERT(VARCHAR, MONTH(DATEADD(M,-1, GETDATE() )))+'01' end and CONVERT (VARCHAR, YEAR(GETDATE()))+ replicate('0',2-len(convert(varchar, MONTH(GETDATE())))) + convert(varchar, MONTH(GETDATE()))+'01'";
            $query = $conexion->prepare($sql);
            $query->execute();
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function mmateriales($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT em.NOMBEMPRESA empresa, ei.coditem CodigoItem, replace(replace(replace(ei.descripcion, char(9), ''), char(13),''), char(10), '') DescripcionItem, ei.iduom IdUnidadMedida,u.DESCRIPLARGA unidadMedida,CASE WHEN ei.ACTIVO = 1 THEN 'Si' else 'No'  END  as Activo, ei.porcimpuesto, ei.fechacreacion fechacreacion, ei.fechaactualizacion,replace(replace(replace(mc.descripcion, char(9),''), char(13),''), char(10), '') DescripcionClasificacion,replace(replace(replace(mc.ruta, char(9), ''), char(13),''), char(10), '') RutaItem from empitem ei inner join MSTRITEM mi on ei.IDMSTRITEM = mi.IDMSTRITEM inner join uom u on ei.iduom = u.iduom inner join MSTRCLASIFICACION mc on mc.IDNODO = mi.IDNODO inner join EMPRESAS em on em.IDEMPRESA = ei.IDEMPRESA  where convert(varchar(8), ei.FECHAACTUALIZACION, 112) between ? and ? order by em.NOMBEMPRESA ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function mmateriales2($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT em.NOMBEMPRESA empresa,ei.coditem CodigoItem, replace(replace(replace(ei.descripcion, char(9), ''), char(13),''), char(10), '') DescripcionItem, ei.iduom IdUnidadMedida,u.DESCRIPLARGA unidadMedida,CASE WHEN ei.ACTIVO = 1 THEN 'Si' else 'No'  END  as Activo, ei.porcimpuesto, ei.fechacreacion fechacreacion, ei.fechaactualizacion,replace(replace(replace(mc.descripcion, char(9),''), char(13),''), char(10), '') DescripcionClasificacion,replace(replace(replace(mc.ruta, char(9), ''), char(13),''), char(10), '') RutaItem from empitem ei inner join MSTRITEM mi on ei.IDMSTRITEM = mi.IDMSTRITEM inner join uom u on ei.iduom = u.iduom inner join MSTRCLASIFICACION mc on mc.IDNODO = mi.IDNODO inner join EMPRESAS em on em.IDEMPRESA = ei.IDEMPRESA  where convert(varchar(8), ei.FECHAACTUALIZACION, 112) between ? and ? and em.IDEMPRESA = ? order by em.NOMBEMPRESA ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function recepciones($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT distinct emp.NOMBEMPRESA 'Empresa', OC.NUMOC 'NumOrdenCompra' ,ISNULL(emv.NOMBFANTASIA, '') 'Proveedor',OC.FECHAENVIO 'Fechaenvioprov' ,REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(oc.total - oc.descuentos) AS DECIMAL (18,2)))), '.', ',') 'TotalNetoOC', ISNULL( REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(OC.TOTAL * RECEPCIONES.IMPUESTO / 100 ) AS DECIMAL (18,2)))), '.', ','),'') 'IvaOC',occe.IDCENTCOSTO 'PartidaPresupuestal',ISNULL(RECEPCIONES.NRODOCRESPALDO,'') 'NumDocRecepcion',ISNULL(REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(RECEPCIONES.COSTOTOTAL ) AS DECIMAL (18,2)))), '.', ','),'') 'MontoNetoRecibido',ISNULL(REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(RECEPCIONES.COSTOTOTAL * RECEPCIONES.IMPUESTO / 100 ) AS DECIMAL (18,2)))), '.', ','),'') 'IvaRecibido',ISNULL(REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(oc.total * RECEPCIONES.IMPUESTO/100 + OC.TOTAL) AS DECIMAL (18,2)))), '.', ','),'') 'Total',ISNULL(RECEPCIONES.FECHACREACION,'') 'FechaRecepcion',CASE WHEN estado.IDESTADODOC = 61 THEN 'Ingreso' else estado.DESCRIPCIONC  END  as 'estado',ISNULL(RECEPCIONES.NUMDOC,'') 'comprobantedeingreso', estadoc.DESCRIPCION estadoocre,estadocc.DESCRIPCION estadooc from RECEPCIONES right join OC on RECEPCIONES.NRODOCORIGEN = OC.NUMOC full outer join orgc on ORGC.IDORGC = RECEPCIONES.IDORGC full outer join EMPRESAS emv on emv.IDEMPRESA = RECEPCIONES.IDEMPRESAV full outer join OCLNDISTRIBUCION occ on occ.IDOC = OC.IDOC full outer join orgccentrocosto occe on occe.IDCENTCOSTO = occ.IDCENTCOSTO full outer join ESTADOSDOC estado on estado.IDESTADODOC = RECEPCIONES.IDESTADO full outer join EMPRESAS emp on emp.IDEMPRESA = OC.IDEMPRESA full outer join ESTADOSDOC estadoc on estadoc.IDESTADODOC = OC.IDESTADORECEPCION full outer join ESTADOSDOC estadocc on estadocc.IDESTADODOC = OC.IDESTADODOC where CONVERT(varchar(8), OC.FECHAENVIO,112) between ? and ?  GROUP BY emp.NOMBEMPRESA,  OC.NUMOC,emv.NOMBFANTASIA,OC.FECHAENVIO,occe.IDCENTCOSTO,RECEPCIONES.NRODOCRESPALDO,RECEPCIONES.COSTOTOTAL,RECEPCIONES.FECHACREACION,estado.IDESTADODOC,RECEPCIONES.NUMDOC,estado.DESCRIPCIONC,estadoc.DESCRIPCION,estadocc.DESCRIPCION ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;

       }

       function recepciones2($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT distinct emp.NOMBEMPRESA 'Empresa', OC.NUMOC 'NumOrdenCompra' ,ISNULL(emv.NOMBFANTASIA, '') 'Proveedor',OC.FECHAENVIO 'Fechaenvioprov' ,REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(oc.total - oc.descuentos) AS DECIMAL (18,2)))), '.', ',') 'TotalNetoOC', ISNULL( REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(OC.TOTAL * RECEPCIONES.IMPUESTO / 100 ) AS DECIMAL (18,2)))), '.', ','),'') 'IvaOC',occe.IDCENTCOSTO 'PartidaPresupuestal',ISNULL(RECEPCIONES.NRODOCRESPALDO,'') 'NumDocRecepcion',ISNULL(REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(RECEPCIONES.COSTOTOTAL ) AS DECIMAL (18,2)))), '.', ','),'') 'MontoNetoRecibido',ISNULL(REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(RECEPCIONES.COSTOTOTAL * RECEPCIONES.IMPUESTO / 100 ) AS DECIMAL (18,2)))), '.', ','),'') 'IvaRecibido',ISNULL(REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(oc.total * RECEPCIONES.IMPUESTO/100 + OC.TOTAL) AS DECIMAL (18,2)))), '.', ','),'') 'Total',ISNULL(RECEPCIONES.FECHACREACION,'') 'FechaRecepcion',CASE WHEN estado.IDESTADODOC = 61 THEN 'Ingreso' else estado.DESCRIPCIONC  END  as 'estado',ISNULL(RECEPCIONES.NUMDOC,'') 'comprobantedeingreso', estadoc.DESCRIPCION estadoocre,estadocc.DESCRIPCION estadooc from RECEPCIONES right join OC on RECEPCIONES.NRODOCORIGEN = OC.NUMOC full outer join orgc on ORGC.IDORGC = RECEPCIONES.IDORGC full outer join EMPRESAS emv on emv.IDEMPRESA = RECEPCIONES.IDEMPRESAV full outer join OCLNDISTRIBUCION occ on occ.IDOC = OC.IDOC full outer join orgccentrocosto occe on occe.IDCENTCOSTO = occ.IDCENTCOSTO full outer join ESTADOSDOC estado on estado.IDESTADODOC = RECEPCIONES.IDESTADO full outer join EMPRESAS emp on emp.IDEMPRESA = OC.IDEMPRESA full outer join ESTADOSDOC estadoc on estadoc.IDESTADODOC = OC.IDESTADORECEPCION full outer join ESTADOSDOC estadocc on estadocc.IDESTADODOC = OC.IDESTADODOC where CONVERT(varchar(8), OC.FECHAENVIO,112) between ? and ? and OC.IDEMPRESA = ?  GROUP BY emp.NOMBEMPRESA,  OC.NUMOC,emv.NOMBFANTASIA,OC.FECHAENVIO,occe.IDCENTCOSTO,RECEPCIONES.NRODOCRESPALDO,RECEPCIONES.COSTOTOTAL,RECEPCIONES.FECHACREACION,estado.IDESTADODOC,RECEPCIONES.NUMDOC,estado.DESCRIPCIONC,estadoc.DESCRIPCION,estadocc.DESCRIPCION ";              
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;

       }

       function topoc($fechalf1,$fechali){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT  em.NOMBEMPRESA empresa,COUNT(OC.IDOC) sumaoc, REPLACE(CONVERT(VARCHAR(MAX),(CAST(SUM(oc.total - oc.descuentos) AS DECIMAL (18,2)))), '.', ',') total  from oc inner join empresas em on em.IDEMPRESA = OC.IDEMPRESA where convert(varchar(8), oc.fechaenvio, 112) between ? and ? group by em.NOMBEMPRESA order by sumaoc desc";
            $query = $conexion->prepare($sql);
            $query->execute(array($fechalf1,$fechali));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function integrados($empresa,$fechalf1,$fechali){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT DISTINCT EMPRESAS.IDEMPRESA empresa,razon.RUT nit,CASE WHEN EMPRESAS.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,EMPRESAS.NOMBEMPRESA nomempre, EMPRESAS.NOMBFANTASIA emprefan, EMPRESAS.IDTIPOEMPRESA tipoempre, EMPRESAS_1.IDEMPRESA AS Expr1, EMPRESAS_1.NOMBEMPRESA AS Expr2,  USUARIOS.IDUSUARIO usuario,USUARIOS.UBICACION ubicacion, USUARIOS.NOMBRE nomusu, USUARIOS.FECHACREACION creacionusuario, EMPRESAS.FECHACREACION creacionempre, CONTACTOS.IDEMPRESA AS Expr3,  CONTACTOS.NOMCONTACTO nomconta, CONTACTOS.TELEFONO teleconta, CONTACTOS.MOVIL conmovil, CONTACTOS.FAX contfax, CONTACTOS.EMAIL contaemail, CONTACTOS.ACTIVO contactivo, CONTACTOS.ELIMINADO contaeliminado, CONTACTOS.FECHACREACION fechacreacion FROM EMPRESAS AS EMPRESAS_1 INNER JOIN EMPRESASB2B ON EMPRESAS_1.IDEMPRESA = EMPRESASB2B.IDEMPRESAC INNER JOIN EMPRESAS ON EMPRESASB2B.IDEMPRESAV = EMPRESAS.IDEMPRESA INNER JOIN USUARIOS ON EMPRESASB2B.IDEMPRESAV = USUARIOS.IDEMPRESA LEFT OUTER JOIN CONTACTOS ON EMPRESAS.IDEMPRESA = CONTACTOS.IDEMPRESA inner join RAZONSOCIAL razon on razon.IDEMPRESA = EMPRESAS.IDEMPRESA WHERE EMPRESAS_1.IDEMPRESA = ? and  (EMPRESAS.IDTIPOEMPRESA = 2) AND (convert(varchar(8),EMPRESAS.FECHACREACION,112) BETWEEN ? AND ? ) AND (USUARIOS.IDUSUARIO <> 'operaciones') AND (USUARIOS.IDUSUARIO <> 'SISTEMA') AND (USUARIOS.IDUSUARIO <> 'Admin')";
            $query = $conexion->prepare($sql);
            $query->execute(array($empresa,$fechalf1,$fechali));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function integradosall($fechalf1,$fechali){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT DISTINCT EMPRESAS.IDEMPRESA empresa,razon.RUT nit,CASE WHEN EMPRESAS.ELIMINADO = 1 THEN 'Eliminado' ELSE 'Activo' END as EstadoProveedor,EMPRESAS.NOMBEMPRESA nomempre, EMPRESAS.NOMBFANTASIA emprefan, EMPRESAS.IDTIPOEMPRESA tipoempre, EMPRESAS_1.IDEMPRESA AS Expr1, EMPRESAS_1.NOMBEMPRESA AS Expr2,  USUARIOS.IDUSUARIO usuario,USUARIOS.UBICACION ubicacion, USUARIOS.NOMBRE nomusu, USUARIOS.FECHACREACION creacionusuario, EMPRESAS.FECHACREACION creacionempre, CONTACTOS.IDEMPRESA AS Expr3,  CONTACTOS.NOMCONTACTO nomconta, CONTACTOS.TELEFONO teleconta, CONTACTOS.MOVIL conmovil, CONTACTOS.FAX contfax, CONTACTOS.EMAIL contaemail, CONTACTOS.ACTIVO contactivo, CONTACTOS.ELIMINADO contaeliminado, CONTACTOS.FECHACREACION fechacreacion FROM EMPRESAS AS EMPRESAS_1 INNER JOIN EMPRESASB2B ON EMPRESAS_1.IDEMPRESA = EMPRESASB2B.IDEMPRESAC INNER JOIN EMPRESAS ON EMPRESASB2B.IDEMPRESAV = EMPRESAS.IDEMPRESA INNER JOIN USUARIOS ON EMPRESASB2B.IDEMPRESAV = USUARIOS.IDEMPRESA LEFT OUTER JOIN CONTACTOS ON EMPRESAS.IDEMPRESA = CONTACTOS.IDEMPRESA inner join RAZONSOCIAL razon on razon.IDEMPRESA = EMPRESAS.IDEMPRESA WHERE (EMPRESAS.IDTIPOEMPRESA = 2) AND (convert(varchar(8),EMPRESAS.FECHACREACION,112) BETWEEN ? AND ? ) AND (USUARIOS.IDUSUARIO <> 'operaciones') AND (USUARIOS.IDUSUARIO <> 'SISTEMA') AND (USUARIOS.IDUSUARIO <> 'Admin')";
            $query = $conexion->prepare($sql);
            $query->execute(array($fechalf1,$fechali));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function orgvintegrados($visibilidad,$fechalf1,$fechali){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT em.IDEMPRESA idempresa,razo.RUT nit,em.NOMBEMPRESA as PROVEEDOR,CASE WHEN em.VISIBILIDAD = 1 THEN 'INTEGRADO' WHEN em.VISIBILIDAD = 2 THEN 'NO INTEGRADO' WHEN em.VISIBILIDAD = 3 THEN 'EXCLUSIVO' ELSE 'NO DEFINIDO' END as VISIBILIDAD,orgv.TELEFONO 'TELEFONO',orgv.EMAIL 'EMAIL',CASE WHEN orgv.ACTIVO = 1 THEN 'SI' WHEN ORGV.ACTIVO = 0 THEN 'NO' END as ACTIVO from ORGV inner join empresas em on em.IDEMPRESA = orgv.IDORGV inner join RAZONSOCIAL razo on razo.IDEMPRESA = orgv.IDEMPRESA inner join empresas emm on emm.IDEMPRESA = orgv.IDEMPRESA where em.VISIBILIDAD = ? and convert(varchar(8), orgv.FECHACREACION,112) between ? and ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($visibilidad,$fechalf1,$fechali));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function pedidopm($fechalf1,$fechali){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT PM.NUMPM NLinea,pmli.NUMLINEAPM numlineas,em.NOMBEMPRESA empresa,PM.NOMPM Nombre,ORGC.NOMBRE orgc,PM.FECHAENVIO fechaprovacion,PM.IDUSUARIO solicitante,pmli.IDARTICULO codigo,pmli.NOMBARTICULO descripcion, pmli.GLOSA observaciones,pmli.FECHADESPACHO fechaentrega,pmli.IDUOM unidad,pmli.CANTIDAD cantidad,pmli.CANTIDADCOMPRADA cantcomprada,pmli.CANTIDADTRASPASADA cantdespacho,pmli.CANTIDADGESTIONADA cantpendiente , esta.DESCRIPCION Estado from PM inner join PMLINEAS pmli on pmli.IDPM = PM.IDPM inner join ESTADOSDOC esta on esta.IDESTADODOC = PM.IDESTADOCOMPRA inner join ORGC on ORGC.IDORGC = PM.IDORGC inner join EMPRESAS em on em.IDEMPRESA = PM.IDEMPRESA where  CONVERT(varchar(8),PM.FECHAENVIO,112) BETWEEN ? AND ? order by em.NOMBEMPRESA ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fechalf1,$fechali));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function pedidopmm($fechalf1,$fechali,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT PM.NUMPM NLinea,pmli.NUMLINEAPM numlineas,em.NOMBEMPRESA empresa,PM.NOMPM Nombre,ORGC.NOMBRE orgc,PM.FECHAENVIO fechaprovacion,PM.IDUSUARIO solicitante,pmli.IDARTICULO codigo,pmli.NOMBARTICULO descripcion, pmli.GLOSA observaciones,pmli.FECHADESPACHO fechaentrega,pmli.IDUOM unidad,pmli.CANTIDAD cantidad,pmli.CANTIDADCOMPRADA cantcomprada,pmli.CANTIDADTRASPASADA cantdespacho,pmli.CANTIDADGESTIONADA cantpendiente , esta.DESCRIPCION Estado from PM inner join PMLINEAS pmli on pmli.IDPM = PM.IDPM inner join ESTADOSDOC esta on esta.IDESTADODOC = PM.IDESTADOCOMPRA inner join ORGC on ORGC.IDORGC = PM.IDORGC inner join EMPRESAS em on em.IDEMPRESA = PM.IDEMPRESA where  CONVERT(varchar(8),PM.FECHAENVIO,112) BETWEEN ? AND ? and em.IDEMPRESA = ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fechalf1,$fechali,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function czestado($fecha1,$fecha2,$estado){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT em.NOMBEMPRESA EmpresaCompradora,ORGC.NOMBRE centrocostos, CZ.IDCZ idcotizacion,CZ.IDUSUARIO usuario,CZ.NOMCZ nombrecot,CZ.NUMCZ numcot,despa.DESCRIPCORTA despacho,pago.DESCRIPCORTA formapago,CZ.FECHACREACION fechacrea, CZ.FECHACIERRE fechacie,estado.DESCRIPCION estado from CZ inner join ESTADOSDOC estado on estado.IDESTADODOC = CZ.IDESTADODOC inner join EMPRESAS em on em.IDEMPRESA = CZ.IDEMPRESA inner join ORGC on ORGC.IDORGC = CZ.IDORGC inner join METODOSDESPACHO despa on despa.IDMETODODESPACHO = CZ.IDMETODODESPACHO inner join FORMASPAGO pago on pago.IDFORMAPAGO = CZ.IDFORMAPAGO where CONVERT(varchar(8), cz.FECHACREACION, 112) between ? and ? and cz.IDESTADODOC = ? order by CZ.FECHACREACION";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$estado));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function calcularofertas($cznombre){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT cz.IDCZ idcz from cz where NOMCZ like $cznombre ";
            $query = $conexion->prepare($sql);
            $query->execute(array($cznombre));
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function oferesult($idczall){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct ORGV.NOMBRE Proveedor,  Convert(Varchar(10),ofe.FECHAENVIO,103) Fechaoferta,replace(sum(precio*cantidad),'.',',') Montototal,ofe.NOMOF nombreoferta,ORGC.NOMBRE nomorgc,COUNT(OFLINEAS.IDRESPUESTA) lineas from OFLINEAS inner join [OF] ofe on ofe.IDOF = OFLINEAS.IDOF inner join ORGC on ORGC.IDORGC = OFLINEAS.IDORGC inner join ORGV on ORGV.IDORGV = OFLINEAS.IDORGV where  oflineas.IDCZ = ? and ofe.NOMOF <> '' and ofe.IDESTADODOC = 31 and OFLINEAS.IDRESPUESTA = 1 GROUP BY ORGV.NOMBRE,ofe.FECHAENVIO,ofe.NOMOF,ORGC.NOMBRE HAVING sum(precio*cantidad) >0 order by Montototal asc";
            $query = $conexion->prepare($sql);
            $query->execute(array($idczall));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function restaoferta($idczalll){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT top 2 ORGV.NOMBRE Proveedor,  Convert(Varchar(10),ofe.FECHACREACION,103) Fechaoferta,replace(sum(precio*cantidad),'.',',')  Montototal,ofe.NOMOF nombreoferta from OFLINEAS inner join [OF] ofe on ofe.IDOF = OFLINEAS.IDOF inner join ORGV on ORGV.IDORGV = OFLINEAS.IDORGV where  oflineas.IDCZ = ? and ofe.IDESTADODOC = 31 GROUP BY ORGV.NOMBRE,ofe.FECHACREACION,ofe.NOMOF HAVING sum(precio*cantidad) >0 order by Montototal asc";
            $query = $conexion->prepare($sql);
            $query->execute(array($idczalll));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function listavendedores($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct e.NOMBFANTASIA emprecompradora,em.NOMBFANTASIA empresavendedora,sum(OC.TOTAL) total from oc inner join EMPRESAS em on em.IDEMPRESA = OC.IDEMPRESAV inner join OCLINEAS ol on ol.IDOC = OC.IDOC inner join EMPRESAS e on e.IDEMPRESA = ol.IDEMPRESA where convert(varchar(8),oc.fechaenvio, 112) between $fecha1 and $fecha2 and em.IDEMPRESA in ($idempresa) GROUP BY e.NOMBFANTASIA,em.NOMBFANTASIA,em.IDEMPRESA order by total desc";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function graficavendedores($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct top 10 em.NOMBFANTASIA empresavendedora,ROUND(CEILING(sum(OC.TOTAL) ) ,2)total from oc inner join EMPRESAS em on em.IDEMPRESA = OC.IDEMPRESAV where convert(varchar(8),oc.fechaenvio, 112) between $fecha1 and $fecha2 and em.IDEMPRESA in ($idempresa) GROUP BY em.NOMBFANTASIA,em.IDEMPRESA order by total desc";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function porcentaje1($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct top 1 em.NOMBFANTASIA empresavendedora,REPLACE(CONVERT(VARCHAR(MAX),(CAST(sum(OC.TOTAL) AS DECIMAL (18,2) ))), '.', ',') total from oc inner join EMPRESAS em on em.IDEMPRESA = OC.IDEMPRESAV where convert(varchar(8),oc.fechaenvio, 112) between $fecha1 and $fecha2 and em.IDEMPRESA in ($idempresa) GROUP BY em.NOMBFANTASIA,em.IDEMPRESA order by total desc";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

         function numporcentventas($fecha1,$fecha2,$idempresa){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT top 1 ROUND(CEILING(sum(OC.TOTAL) ) ,2) total from oc inner join EMPRESAS em on em.IDEMPRESA = OC.IDEMPRESAV where convert(varchar(8),oc.fechaenvio, 112) between $fecha1 and $fecha2  and em.IDEMPRESA in ($idempresa) ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2,$idempresa));
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function ofertasocitems($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT distinct  rtrim(replace(replace(replace(replace(ec.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreEmpresaCompradora,rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora,cz.numcz, rtrim(replace(replace(replace(replace(cz.nomcz, char(9), ''), char(44), ''),char(13),''),char(10),'')) nombreCotizacion,cz.FECHACREACION FechaCreacionCotizacion, ed.DESCRIPCION estadoCotizacion, czp.IDEMPRESAV IDEmpresaInvitada,rtrim(replace(replace(replace(replace(eczp.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaInvitada,rtrim(replace(replace(replace(replace(ofe.NOMOF, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreOferta,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,rtrim(replace(replace(replace(replace(oo.nombre, char(44), ''), char(9), ''),char(13),''),char(10),'')) sucursalOferto,rtrim(replace(replace(replace(replace(czlinea.NOMBARTICULO, char(44), ''), char(9), ''),char(13),''),char(10),'')) Detalle,rtrim(replace(replace(replace(replace(czlinea.IDARTICULO , char(44), ''), char(9), ''),char(13),''),char(10),'')) codigoitems,REPLACE(CONVERT(VARCHAR(MAX),(CAST(ofl.PRECIO AS DECIMAL (18,2)))), '.', ',') precioitem,czlinea.CANTIDAD cantidad,rtrim(replace(replace(replace(replace((case when ofe.IDESTADOADJ = 1 then 'Adjudicada' else 'NO Adjudicada' end), char(9), ''), char(44), ''),char(13),''),char(10),''))   EstadoAdjudicacionOferta,rtrim(replace(replace(replace(replace((select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC), char(44), ''), char(9), ''),char(13),''),char(10),'')) estadoOferta,case when (select descripcion from estadosdoc where IDESTADODOC = ofe.IDESTADODOC) = 'Oferta Guardada' or (select sum(precio*cantidad) from oflineas o where o.IDOF = ofe.IDOF ) <= 0 then 'NO' else 'SI' end Oferto from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA =cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV inner join CZLINEAS czlinea on czlinea.IDCZ = CZ.IDCZ inner join OFLINEAS ofl on ofl.IDOF = ofe.IDOF where convert(varchar(8), cz.FECHACREACION, 112) between ? and ? and ec.IDEMPRESA = 79609 ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function infocitems($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT oc.idoc,emp2.idempresa idEmpresaCompradora,emp2.nombempresa EmpresaCompradora,orc.idorgc idOrgCompra,orc.nombre nombreOrgCompra,emp.idempresa idEmpresaProveedora,emp.nombempresa EmpresaProveedora,orv.idorgv idSucursalVenta,orv.nombre SucursalVenta,oc.fechaenvio,oc.numoc NoOC,oc.idmoneda moneda,REPLACE(CONVERT(VARCHAR(MAX),(CAST(ocl.PRECIOUNITARIO AS DECIMAL (18,2)))), '.', ',') preciouni,ed.idestadodoc idEstadoDoc,ed.descripcion estadodoc from oc inner join empresas emp on emp.idempresa = oc.idempresav inner join empresas emp2 on emp2.idempresa = oc.idempresa inner join orgc orc on orc.idorgc = oc.idorgc inner join orgv orv on orv.idorgv = oc.idorgv inner join estadosdoc ed on oc.idestadodoc = ed.idestadodoc left join oclineas ocl on ocl.idoc = oc.idoc where convert(varchar(8),oc.fechaenvio,112) >= ? and emp2.IDEMPRESA  = 79609 group by oc.idoc,oc.numoc,oc.idempresav,rutorgv,emp.nombempresa,emp2.nombempresa,orc.nombre,oc.nomoc,oc.fechaenvio,ed.descripcion,oc.idmoneda,emp2.idempresa,orc.idorgc,emp.idempresa,orv.idorgv,orv.nombre,oc.total,oc.descuentos,ed.idestadodoc,ocl.IDARTICULO,ocl.PRECIOUNITARIO order by oc.fechaenvio ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function maestrologo($tipom,$fechaini,$fechafinal){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT InMaLo_TipoMaestro,InMaLo_FechaProcesado,InMaLo_ResultadoProceso,InMaLo_DatoPrincipal,InMaLo_DatoPrincipalGC,InMaLo_DatoRespuestaAR,InMalo_DatosEntrada from IntegracionMaestrosLog where InMaLo_TipoMaestro like $tipom and InMaLo_ResultadoProceso like '%error%' and CONVERT(varchar(8), InMaLo_FechaProcesado, 112) between $fechaini and $fechafinal ";
            $query = $conexion->prepare($sql);
            $query->execute(array($tipom,$fechaini,$fechafinal));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function maestrologoall($fechaini,$fechafinal){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT InMaLo_TipoMaestro,InMaLo_FechaProcesado,InMaLo_ResultadoProceso,InMaLo_DatoPrincipal,InMaLo_DatoPrincipalGC,InMaLo_DatoRespuestaAR,InMalo_DatosEntrada from IntegracionMaestrosLog where InMaLo_ResultadoProceso like '%error%' and CONVERT(varchar(8), InMaLo_FechaProcesado, 112) between $fechaini and $fechafinal ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fechaini,$fechafinal));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function maestrologofer($idof){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "exec [dbo].SP_Integracion_Ofertas]  @P_IDOF = $idof  ";
            $query = $conexion->prepare($sql);
            $query->execute($idof);
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function maestrologcoti($idcoti){
            $xml3 = str_replace('{','<',$idcoti);
            $xml4 = str_replace('}','>',$xml3);
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute( PDO::ATTR_EMULATE_PREPARES, false ); 
            $sql = "EXEC [dbo].[SP_Integracion_Cotizacion] @XML = ''<ENCABEZADO><FILA IDEMPRESA=''PRUEBARONAL'' IDCENTROCOSTO=''minc|0011'' IDUSUARIO=''operaciones'' NOMBRECOTIZACION=''-M-SP001499'' NUMEROCOTIZACION=''M-SP001499'' MONEDACOTIZACION=''COP'' PORCENTAJECOTIZACION=''19.0'' FORMADESPACHO=''TERRESTRE'' DIRECCIONDESPACHO='' IDORGANIZACIONTRASPASO=''minc|0011'' FORMASDEPAGO=''30 DIAS'' FECHAENVIOCOTIZACIONPROOVEDOR=''2018-05-04'' FECHACIERRECOTIZACION=''2018-05-10'' FECHADECISIONCOMPRA=''2018-05-10'' COMENTARIOSENCABEZADOCOTIZACION='' FECHACREACIONCOTIZACION=''2018-05-04'' ESTADOCOTIZACION=''22'' OBSERVACIONEGENERALES='' COMENTARIOCOTIZACION='' NOMBRESOLICITANTE=''Oscar Alrey Vergara Pati?o''/></ENCABEZADO><DETALLE><FILA IDEMPRESA=''PRUEBARONAL''IDCENTROCOSTO=''minc|0011'' IDCZ='' NUMLINEACZ=''1'' IDORGCLINEA=''minc|0011'' CANTIDAD=''24.00'' IDUOM=''und|und'' IDMSTRITEM=''0542228-'' IDARTICULO=''0542228-|TOALLA MANO DE PAPEL'' IDPM='' IDPMLINEA='' NUMLINEAPM='' DIASDESPACHO='' FECHADESPACHO=''2018-05-15'' IDMONEDA=''COP'' IDPARTIDA='' DESCRIPCIONPARTIDA='' IDESTADODOC=''22'' FECHAESTADO=''2018-05-04'' PORCIMPUESTO=''-1.10'' GLOSA=''/><FILA IDEMPRESA=''PRUEBARONAL'' IDCENTROCOSTO=''minc|0011'' IDCZ='' NUMLINEACZ=''2'' IDORGCLINEA=''minc|0011'' CANTIDAD=''24.00'' IDUOM=''und|und'' IDMSTRITEM=''0542228-'' IDARTICULO=''0542228-|TOALLA MANO DE PAPEL'' IDPM='' IDPMLINEA='' NUMLINEAPM='' DIASDESPACHO='' FECHADESPACHO=''2018-05-15'' IDMONEDA=''COP'' IDPARTIDA='' DESCRIPCIONPARTIDA='' IDESTADODOC=''22'' FECHAESTADO=''2018-05-04'' PORCIMPUESTO=''-1.10'' GLOSA=''/><FILA IDEMPRESA=''PRUEBARONAL'' IDCENTROCOSTO=''minc|0011'' IDCZ='' NUMLINEACZ=''3'' IDORGCLINEA=''minc|0011'' CANTIDAD=''20.00''IDUOM=''und|und'' IDMSTRITEM=''103412V-SIN MARCA'' IDARTICULO=''103412V-SIN MARCA|BOMBILLO 1034 2 CONTACTOS 12 VOLTIOS'' IDPM='' IDPMLINEA='' NUMLINEAPM='' DIASDESPACHO='' FECHADESPACHO=''2018-05-15'' IDMONEDA=''COP'' IDPARTIDA='' DESCRIPCIONPARTIDA='' IDESTADODOC=''22'' FECHAESTADO=''2018-05-04'' PORCIMPUESTO=''-1.10'' GLOSA=''/></DETALLE><PARTICIPANTES><FILA IDEMPRESAC=''PRUEBARONAL'' IDORGC=''minc|0011'' IDEMPRESAV=''800175064-4'' IDCZ=''M-SPP0001285''/><FILA IDEMPRESAC=''PRUEBARONAL'' IDORGC=''minc|0011'' IDEMPRESAV=''900471617-9'' IDCZ=''M-SPP0001285''/></PARTICIPANTES>',   @MSG = '' ";
            $query = $conexion->prepare($sql);
            $query->execute();
            $results = $query->fetch(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function creararchivo($nomimagen,$archivo_pdf){
            $conexion=ccimarketplace::Connect();
            $conexion->SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta="INSERT INTO  sliderpublicidad (nomimagen,archivo_pdf) values(?,?)";
            $query=$conexion->prepare($consulta);
            $query->execute(array($nomimagen,$archivo_pdf));

            ccimarketplace::Disconnect();
        }

        function centro_de_costos($fechaini,$fechafinal){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "SELECT case when ORGC.ACTIVO = 1 then 'ACTIVO' else 'INACTIVO' END AS 'ESTADO' ,em.NOMBEMPRESA 'EMPRESA', 
            ORGC.IDEMPRESA idempresa,orgc.IDORGC idorgc,ORGC.NOMBRE orgcnombre,ORGC.COMENTARIOS orgccomentarios,ORGC.IDMAESTRO orgcmaestro,ORGC.IDUSUARIONNI orgcusuarioini,
            ORGC.FECHAACTUALIZACION orgcfechaactuali,ORGC.FECHAACTUALIZACIONMONITOR orgcfechaactumoni,ORGC.TELEFONO orgctelefono,ORGC.CODIGO orgccodigo,ORGC.CENTCOSTOUSASC orgccento,ORGC.ESINTEGRADO orgcesinte,ORGC.FECHAULTIMACOMPRA orgcfechaulticom
            from ORGC inner join EMPRESAS em on em.IDEMPRESA= ORGC.IDEMPRESA where convert(varchar(8),ORGC.FECHAACTUALIZACION,112) BETWEEN ? AND ? order by ORGC.ACTIVO asc";
            $query = $conexion->prepare($sql);
            $query->execute(array($fechaini,$fechafinal));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function OC_aceptadas($idempresa,$fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT  OC.IDEMPRESA ocidempresa,EMPRESAS.NOMBFANTASIA 'CONSTRUCTORA',OC.NUMOC numoc,
                    ed.idestadodoc idestadooc,ed.descripcion estadooc,OC.FECHACREACION fechacreacion,OCHISTORICO.FECHA fechaaprovacion
                    ,OC.[FECHAENVIO] 'FECHAENVIO',empro.NOMBFANTASIA empresaproveedor,OC.DESCUENTOS 'DESCUENTOS',OC.CARGOS 'CARGOS',
                    REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') TOTAL
                    FROM OC inner join EMPRESAS ON EMPRESAS.IDEMPRESA = OC.IDEMPRESA inner join EMPRESAS empro on empro.IDEMPRESA = OC.IDEMPRESAV
                    inner join estadosdoc ed on OC.IDESTADODOC = ed.IDESTADODOC
                    left join ORGV ON ORGV.IDORGV = OC.IDORGV
                    LEFT JOIN OCHISTORICO ON OCHISTORICO.IDOC = OC.IDOC
                    WHERE IDEMPRESAV IN (?)
                    AND OCHISTORICO.IDESTADODOC = 47 and convert(varchar(8),OCHISTORICO.FECHA,112) BETWEEN ? and ?
                    order by EMPRESAS.NOMBFANTASIA asc";
            $query = $conexion->prepare($sql);
            $query->execute(array($idempresa,$fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function OC_aceptadas_empresas($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT  OC.IDEMPRESA ocidempresa,EMPRESAS.NOMBFANTASIA 'CONSTRUCTORA',OC.NUMOC numoc,
                    ed.idestadodoc idestadooc,ed.descripcion estadooc,OC.FECHACREACION fechacreacion,OCHISTORICO.FECHA fechaaprovacion
                    ,OC.[FECHAENVIO] 'FECHAENVIO',empro.NOMBFANTASIA empresaproveedor,OC.DESCUENTOS 'DESCUENTOS',OC.CARGOS 'CARGOS',
                    REPLACE(CONVERT(VARCHAR(MAX),(CAST(oc.total - oc.descuentos AS DECIMAL (18,2)))), '.', ',') TOTAL
                    FROM OC inner join EMPRESAS ON EMPRESAS.IDEMPRESA = OC.IDEMPRESA inner join EMPRESAS empro on empro.IDEMPRESA = OC.IDEMPRESAV
                    inner join estadosdoc ed on OC.IDESTADODOC = ed.IDESTADODOC
                    left join ORGV ON ORGV.IDORGV = OC.IDORGV
                    LEFT JOIN OCHISTORICO ON OCHISTORICO.IDOC = OC.IDOC
                    WHERE OCHISTORICO.IDESTADODOC = 47 and convert(varchar(8),OCHISTORICO.FECHA,112) BETWEEN ? and ?
                    order by EMPRESAS.NOMBFANTASIA asc";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function ProveedoresInvitadosCZ1($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct CZ.NUMCZ NUM_COTIZACION,cz.IDEMPRESA IDEMCOMPRADOR,em.NOMBFANTASIA NOMCOMPRADOR,EMPRESAS.NOMBEMPRESA,ORGV.EMAIL,ORGV.TELEFONO,CZ.FECHAPUBLICACION,czli.IDARTICULO,czli.NOMBARTICULO,czli.CANTIDAD 
                from CZPARTICIPANTES inner join CZ on CZ.IDCZ = CZPARTICIPANTES.IDCZ 
                inner join ORGV on ORGV.IDORGV = CZPARTICIPANTES.IDORGV 
                inner join EMPRESAS on EMPRESAS.IDEMPRESA = ORGV.IDEMPRESA
                inner join CZLINEAS czli on czli.IDCZ = CZPARTICIPANTES.IDCZ
                inner join EMPRESAS em on em.IDEMPRESA = cz.IDEMPRESA where 
                CONVERT(varchar(8), CZ.FECHAPUBLICACION, 112) BETWEEN ? and ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function ProveedoresInvitadosCZ2($NumCZ,$fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct CZ.NUMCZ NUM_COTIZACION,cz.IDEMPRESA IDEMCOMPRADOR,em.NOMBFANTASIA NOMCOMPRADOR,EMPRESAS.NOMBEMPRESA,ORGV.EMAIL,ORGV.TELEFONO,CZ.FECHAPUBLICACION,czli.IDARTICULO,czli.NOMBARTICULO,czli.CANTIDAD 
                from CZPARTICIPANTES inner join CZ on CZ.IDCZ = CZPARTICIPANTES.IDCZ 
                inner join ORGV on ORGV.IDORGV = CZPARTICIPANTES.IDORGV 
                inner join EMPRESAS on EMPRESAS.IDEMPRESA = ORGV.IDEMPRESA
                inner join CZLINEAS czli on czli.IDCZ = CZPARTICIPANTES.IDCZ
                inner join EMPRESAS em on em.IDEMPRESA = cz.IDEMPRESA where CZ.NUMCZ = ? and
                CONVERT(varchar(8), CZ.FECHAPUBLICACION, 112) BETWEEN ? and ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($NumCZ,$fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function ProveedoresInvitadosCZ3($NumCZ){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct CZ.NUMCZ NUM_COTIZACION,cz.IDEMPRESA IDEMCOMPRADOR,em.NOMBFANTASIA NOMCOMPRADOR,EMPRESAS.NOMBEMPRESA,ORGV.EMAIL,ORGV.TELEFONO,CZ.FECHAPUBLICACION,czli.IDARTICULO,czli.NOMBARTICULO,czli.CANTIDAD 
                from CZPARTICIPANTES inner join CZ on CZ.IDCZ = CZPARTICIPANTES.IDCZ 
                inner join ORGV on ORGV.IDORGV = CZPARTICIPANTES.IDORGV 
                inner join EMPRESAS on EMPRESAS.IDEMPRESA = ORGV.IDEMPRESA
                inner join CZLINEAS czli on czli.IDCZ = CZPARTICIPANTES.IDCZ
                inner join EMPRESAS em on em.IDEMPRESA = cz.IDEMPRESA where CZ.NUMCZ = ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($NumCZ));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }

        function CotizacionesProveedorOferto($fecha1,$fecha2){
            $conexion = ccimarketplace::Connect();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT distinct CZ.NUMCZ NUM_COTIZACION,cz.IDEMPRESA IDEMCOMPRADOR,rtrim(replace(replace(replace(replace(em.NOMBFANTASIA, char(44), ''), char(9), ''),char(13),''),char(10),''))
                NOMCOMPRADOR,rtrim(replace(replace(replace(replace(oc.NOMBRE, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreCcostosCompradora, cz.idorgc idcentrocostoCompradora,rtrim(replace(replace(replace(replace(prove.NOMBFANTASIA, char(44), ''), char(9), ''),char(13),''),char(10),'')) EMPRESAINVITADA,
                prove.IDEMPRESA IDEMPRESAINVITADA,ORGV.EMAIL,ORGV.TELEFONO,CZ.FECHAPUBLICACION,rtrim(replace(replace(replace(replace(eo.NOMBEMPRESA, char(44), ''), char(9), ''),char(13),''),char(10),'')) nombreempresaOferto,
                czli.NOMBARTICULO,ed.DESCRIPCION estadoCotizacion from cz inner join CZPARTICIPANTES czp on czp.idcz = cz.idcz inner join ORGV on ORGV.IDORGV = czp.IDORGV and cz.IDEMPRESA = czp.idempresac and cz.idorgc = czp.idorgc inner join [OF] ofe on ofe.idcz = czp.idcz and ofe.IDEMPRESAC = czp.IDEMPRESAC and ofe.IDORGC = czp.IDORGC and ofe.IDEMPRESAV = czp.IDEMPRESAV and ofe.idorgv = czp.idorgv inner join empresas ec on ec.IDEMPRESA = cz.idempresa inner join orgc oc on oc.IDEMPRESA = cz.idempresa and oc.idorgc = cz.idorgc inner join ESTADOSDOC ed on cz.IDESTADODOC = ed.IDESTADODOC inner join empresas eczp on eczp.IDEMPRESA = czp.IDEMPRESAV inner join empresas eo on eo.IDEMPRESA = ofe.IDEMPRESAV inner join orgv oo on ofe.IDEMPRESAV = oo.IDEMPRESA and oo.IDORGV = ofe.IDORGV inner join ORGVCONTACTO orgvcon on orgvcon.IDORGV = oo.IDORGV inner join CONTACTOS conta on conta.IDCONTACTO = orgvcon.IDCONTACTO inner join ORGVDIRECCION orgdi on orgdi.IDORGV = ofe.IDEMPRESAV
                inner join EMPRESAS prove on prove.IDEMPRESA = ORGV.IDEMPRESA
                inner join CZLINEAS czli on czli.IDCZ = czp.IDCZ
                inner join EMPRESAS em on em.IDEMPRESA = cz.IDEMPRESA
                inner join EMPRESAS emp on emp.IDEMPRESA = czp.IDEMPRESAV where 
                CONVERT(varchar(8), cz.FECHACREACION, 112) BETWEEN ? and ? ";
            $query = $conexion->prepare($sql);
            $query->execute(array($fecha1,$fecha2));
            $results = $query->fetchALL(PDO::FETCH_BOTH);
            ccimarketplace::Disconnect();
            return $results;
        }
	}

?>
