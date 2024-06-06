<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[
    AsCommand(name: 'app:add-category', description: 'Add a category')]
class AddCategoryCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CategoryRepository     $categoryRepository,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $categoriesToAdd = [
            'Travel Destinations',
            'Books & Media',
            'Gadgets & Electronics',
            'Fashion & Accessories',
            'Home & Kitchen'
        ];

        $existingCategories = $this->categoryRepository->findAll();
        $existingCategoryNames = array_map(function (Category $category) {
            return $category->getName();
        }, $existingCategories);

        foreach ($categoriesToAdd as $categoryName) {
            if (!in_array($categoryName, $existingCategoryNames)) {
                $category = new Category();
                $category->setName($categoryName);
                $this->entityManager->persist($category);
            }
            $this->entityManager->flush();
        }
        return Command::SUCCESS;

// or return this if some error happened during the execution
// (it's equivalent to returning int(1))
// return Command::FAILURE;

// or return this to indicate incorrect command usage; e.g. invalid options
// or missing arguments (it's equivalent to returning int(2))
// return Command::INVALID
    }
}