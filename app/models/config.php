<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pelispa');
define('DB_Charset', 'utf8');
?>
<?php
class Model{
    protected $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=pelispa;charset=' . DB_Charset, DB_USER, DB_PASS);
        $this->deploy();
    }

    function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables)==0) {
            $sql =<<<END
        
            --
            -- Base de datos: `pelispa`
            --
            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `peliculas`
            --
            
            CREATE TABLE `peliculas` (
              `id_pelicula` int(11) NOT NULL,
              `nombre` varchar(256) NOT NULL,
              `director` varchar(256) NOT NULL,
              `tipo` varchar(20) NOT NULL,
              `servicio_fk` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            
            --
            -- Volcado de datos para la tabla `peliculas`
            --
            
            INSERT INTO `peliculas` (`id_pelicula`, `nombre`, `director`, `tipo`, `servicio_fk`) VALUES
            (1, 'aa', 'a', '', 2),
            (2, 'La quinta ola', 'James Cammeron', '', 1),
            (3, 'Avengers End Game', 'Lucas Silva', '', 2);
            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `servicio_streaming`
            --
            
            CREATE TABLE `servicio_streaming` (
              `id_servicio_streaming` int(11) NOT NULL,
              `nombre` varchar(256) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            
            --
            -- Volcado de datos para la tabla `servicio_streaming`
            --
            
            INSERT INTO `servicio_streaming` (`id_servicio_streaming`, `nombre`) VALUES
            (1, 'Amazon Prime Video'),
            (2, 'HBO');
            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `users`
            --
            
            CREATE TABLE `users` (
              `id` int(11) NOT NULL,
              `username` varchar(250) NOT NULL,
              `password` varchar(250) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            
            --
            -- Volcado de datos para la tabla `users`
            --
            
            INSERT INTO `users` (`id`, `username`, `password`) VALUES
            (1, 'webadmin', '$2y$10\$KFGlB8MMLJXGs2liUJnRAexQMfnICQgOZeoWYikR6oD8mQlkIanbS');
            
            --
            -- Índices para tablas volcadas
            --
            
            --
            -- Indices de la tabla `peliculas`
            --
            ALTER TABLE `peliculas`
              ADD PRIMARY KEY (`id_pelicula`),
              ADD KEY `fk_servicio_streaming` (`servicio_fk`);
            
            --
            -- Indices de la tabla `servicio_streaming`
            --
            ALTER TABLE `servicio_streaming`
              ADD PRIMARY KEY (`id_servicio_streaming`);
            
            --
            -- Indices de la tabla `users`
            --
            ALTER TABLE `users`
              ADD PRIMARY KEY (`id`);
            
            --
            -- AUTO_INCREMENT de las tablas volcadas
            --
            
            --
            -- AUTO_INCREMENT de la tabla `peliculas`
            --
            ALTER TABLE `peliculas`
              MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
            
            --
            -- AUTO_INCREMENT de la tabla `servicio_streaming`
            --
            ALTER TABLE `servicio_streaming`
              MODIFY `id_servicio_streaming` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
            
            --
            -- AUTO_INCREMENT de la tabla `users`
            --
            ALTER TABLE `users`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
            
            --
            -- Restricciones para tablas volcadas
            --
            
            --
            -- Filtros para la tabla `peliculas`
            --
            ALTER TABLE `peliculas`
              ADD CONSTRAINT `fk_servicio_streaming` FOREIGN KEY (`servicio_fk`) REFERENCES `servicio_streaming` (`id_servicio_streaming`);
            COMMIT;
            
            END;
            $this->db->query($sql);
        }
    }
}
            
