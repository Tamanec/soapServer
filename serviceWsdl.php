<?php

header('Content-type: text/xml; charset=utf-8');

readfile(__DIR__ . '/service.wsdl');