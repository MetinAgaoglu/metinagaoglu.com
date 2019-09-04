<?php
namespace App\Admin;

use App\Entity\Categories;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ContentAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('Content',['class' => 'col-md-9'])
			->add('title', TextType::class)
			->add('content', TextareaType::class)
			->end()
			->with('Meta data',['class' => 'col-md-3'])
			->add('category', ModelType::class, [
				'class' => Categories::class,
				'property' => 'title',
			])
			->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper->add('name');
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper->addIdentifier('name');
	}
}