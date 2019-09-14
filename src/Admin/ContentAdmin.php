<?php
namespace App\Admin;

use App\Entity\Categories;
use App\Entity\Files;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ContentAdmin extends AbstractAdmin
{

	protected $datagridValues = [
		'_page' => 1,
		'_sort_order' => 'DESC',
		'_sort_by' => 'content_id'
	];

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('Content',['class' => 'col-md-9'])
				->add('title', TextType::class)
				->add('description', TextareaType::class)
				->add('content', TextareaType::class)
			->end()
			->with('Meta data',['class' => 'col-md-3'])
				->add('category', ModelType::class, [
					'class' => Categories::class,
					'property' => 'title',
				])
				->add('keywords',TextType::class)
				->add('image',FileType::class,[
					'required' => false,
					'mapped' => false,
					'data_class' => Files::class,
					'constraints' => [
						new File([
							'maxSize' => '1M',
							'mimeTypes' => [
								'image/jpeg',
								'image/png',
							],
							'mimeTypesMessage' => 'Please upload a valid image',
						])
					],
				])
			->end()
		;
	}

	public function prePersist($object)
	{
		dd($object);
		$this->manageFileUpload($object);

	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('title')
			->add('category', null, [], EntityType::class, [
				'class' => Categories::class,
				'choice_label' => 'title',
			])
			;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('content_id')
			->addIdentifier('title')
			->add('category.title')
			;
	}


}