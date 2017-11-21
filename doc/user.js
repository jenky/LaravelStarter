/**
 * @apiDefine UserGroup User
 *
 * **Users.**
 */

/**
 * @apiDefine UserParams
 *
 * @apiParam {String} first_name First name
 * @apiParam {String} last_name Last name
 * @apiParam {String} email Email address
 * @apiParam {String} password Password
 */

/**
 * @api {GET} /users List all users
 * @apiVersion 1.0.0
 * @apiGroup UserGroup
 * @apiDescription List all users.
 */

/**
 * @api {POST} /users Create a new user
 * @apiVersion 1.0.0
 * @apiGroup UserGroup
 * @apiDescription Create a new user.
 *
 * @apiUse UserParams
 * @apiSampleRequest off
 */

/**
 * @api {GET} /users/:id Retrieve the user
 * @apiVersion 1.0.0
 * @apiGroup UserGroup
 * @apiDescription Retrieve the user.
 *
 * @apiSampleRequest /users/1
 */

/**
 * @api {PUT} /users/:id Update an user
 * @apiVersion 1.0.0
 * @apiGroup UserGroup
 * @apiDescription Update an user.
 *
 * @apiUse UserParams
 * @apiSampleRequest off
 */
