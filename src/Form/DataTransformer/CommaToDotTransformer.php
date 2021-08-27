<?php


namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;


class CommaToDotTransformer implements DataTransformerInterface
{
    public function transform($number)
    {
        return $number;
    }

    public function reverseTransform($input)
    {
        return str_replace(',', '.', $input);
    }
}