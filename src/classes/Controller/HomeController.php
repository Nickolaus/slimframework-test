<?php

namespace SlimTest\Controller;

use Jgut\Slim\Controller\Base as BaseController;
use Slim\Http\Request;
use Slim\Http\Response;
use SlimTest\Model\Entity\EntryEntity;
use SlimTest\Model\Mapper\EntryMapper;

class HomeController extends BaseController {

    public function indexAction(Request $request, Response $response, array $args) {

        echo '<pre>';
    //    var_dump($this);die;
        // Sample log message
        $this->logger->info("Slim-Skeleton '/' route");

        $entryMapper = new EntryMapper($this->db);
        $entries = $entryMapper->getEntries();


    // Render index view
        return $this->view->render($response, 'index.html.twig', array(
            'entries' => $entries
        ));
    }

    public function formAction(Request $request, Response $response, array $args) {

        $entryMapper = null;
        if (isset($args['id'])) {
            $entryMapper = new EntryMapper($this->db);
            $entry = $entryMapper->getEntryById($args['id']);
        }
        else {
            $entry = new EntryEntity();
        }

        // form submit
        if ($request->isMethod('POST')) {

            $requestParams = $request->getParams();

            // form validate
            if (isset($requestParams['title']) && 0 < strlen($requestParams['title'])) {
                $entry->setTitle($requestParams['title']);
                $entry->setDescription($requestParams['description']);

                if (null === $entryMapper) {
                    $entryMapper = new EntryMapper($this->db);
                }
                $entryMapper->save($entry);

                $url = $this->router->pathFor('entries');

                return $response->withStatus(302)->withHeader('Location', $url);
            }
        }

        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        $tokenArray = array(
            $nameKey => $name,
            $valueKey => $value,
        );
        $response->write(json_encode($tokenArray));

        return $this->view->render($response, 'form.html.twig', array(
            'entry' => $entry,
            'csrf' => $tokenArray
        ));
    }
}