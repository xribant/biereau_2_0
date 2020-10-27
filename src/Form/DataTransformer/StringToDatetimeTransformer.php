<?php


namespace App\Form\DataTransformer;


use App\Entity\ContactSub;
use App\Entity\RegistrationDate;
use App\Entity\SchoolEntryDate;
use App\Entity\SchoolSection;
use Symfony\Component\Form\DataTransformerInterface;

class StringToDatetimeTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof ContactSub) {
            throw new \LogicException('Expected a Datetime Object');
        }
        return $value->getChildEntryDate()->format('d-m-Y');
    }

    public function reverseTransform($value)
    {
        if ($value instanceof RegistrationDate) {
            return $value->getRegDate();
        } else if ($value instanceof SchoolEntryDate)
        {
            return $value->getEntryDate();
        }
        else if($value instanceof SchoolSection){
            return $value->getSectionFullName();
        }

    }

}