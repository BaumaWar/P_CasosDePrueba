alter table detalle_caso_prueba drop column estado;
alter table caso_prueba drop column estado;
ALTER TABLE `detalle_caso_prueba` ADD COLUMN `resultado_caso` VARCHAR(3000) NULL DEFAULT NULL AFTER `valores_entrada`;