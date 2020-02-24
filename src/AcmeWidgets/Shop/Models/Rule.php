<?php
namespace AcmeWidgets\Shop\Models;

use AcmeWidgets\Shop\Interfaces\RuleInterface;

    class Rule implements RuleInterface
    {
        private $name;

        private $type;

        function __construct()
        {


        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name): void
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @param mixed $type
         */
        public function setType($type): void
        {
            $this->type = $type;
        }

        public function applyRule()
        {
            // TODO: Implement applyRule() method.
        }


    }